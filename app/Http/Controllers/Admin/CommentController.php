<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\BatchComment;
use App\Models\Category;
use App\Models\CollectionMovie;
use App\Models\MovieActor;
use App\Models\MovieCategory;
use App\Models\MovieComment;
use App\Models\MovieDirector;
use App\Models\MovieFilmCompanies;
use App\Models\MovieLabel;
use App\Models\Movie;
use App\Models\MovieNumbers;
use App\Models\MovieScore;
use App\Models\MovieSeries;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserClient;
use App\Models\UserSeenMovie;
use App\Models\UserWantSeeMovie;
use App\Services\Logic\RedisCache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class CommentController extends Controller
{
    public function commentList(Request $request)
    {
        if ($request->method() == 'GET') {
            $file = public_path('/comment_workers');
            if (!is_file($file)) {
                file_put_contents($file, '');
            }
            return View::make('admin.comment.commentList');
        }

        $model = MovieComment::query();
        $date = explode('~', $request->input('date'));
        $model = $model->where('movie_comment.status', '>', 0);//1是正常
        if (isset($date[0]) && isset($date[1])) {
            $model = $model->whereBetween('movie.release_time', [trim($date[0]), trim($date[1])]);
        }
        if ($request->input('number')) {
            $model = $model->where('movie.number', $request->input('number'));
        }
        if ($request->input('nickname')) {
            $model->whereRaw('(user_client.nickname = \'' . $request->input('nickname') . '\' or movie_comment.nickname = \'' . $request->input('nickname') . '\')');
        }
        if (!is_null($request->input('audit')) && $request->input('audit') !== '') {
            $model = $model->where('movie_comment.audit', $request->input('audit'));
        }
        if (!is_null($request->input('source_type')) && $request->input('source_type') !== '') {
            $model = $model->where('movie_comment.source_type', $request->input('source_type'));
        }

        $res = $model->orderBy('movie_comment.id', 'DESC')
            ->leftJoin('user_client', 'user_client.id', '=', 'movie_comment.uid')
            ->leftJoin('movie', 'movie.id', '=', 'movie_comment.mid')
            ->select('movie_comment.id', 'movie_comment.comment_time',
                'movie.number', 'movie.name as movie_name', 'movie_comment.comment as comment',
                'user_client.nickname as nickname', 'movie_comment.nickname as cnickname', 'movie_comment.source_type as source_type', 'movie_comment.uid as uid', 'movie_comment.audit as audit', 'movie_comment.status as status')
            ->paginate($request->get('limit', 30));

        foreach ($res as &$val) {
            $val->nickname = ($val->nickname ?? ($val->cnickname)) ?? '';
            $val->source_type = MovieComment::COMMENT_SORT_TYPE[$val->source_type] ?? '未知';
            //$val->nickname = $val->nickname .((($val->uid??0) <= 0)?('['.$val->source_type.']'):('[uid:'.($val->uid??0).']'));
            switch ($val->audit) {
                case 0:
                    $val->audit = '待审核';
                    break;
                case 1:
                    $val->audit = '正常';
                    break;
                case -1:
                    $val->audit = '审核不通过';
                    break;
            }
            if ($val->status == 1) {
                $val->status = '显示';
            } else {
                $val->status = '隐藏';
            }
        }

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    public function commentDel(Request $request)
    {
        MovieComment::where('id', $request->input('id') ?? 0)->update(['status' => 2]);
        return Redirect::to(URL::route('admin.movie.movie.commentList'))->with(['success' => '隐藏成功']);
    }

    /**
     * 删除评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function commentDestroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!is_array($ids) || empty($ids)) {
            return Response::json(['code' => 1, 'msg' => '请选择隐藏项']);
        }
        if (count($ids) <= 0) {
            return Response::json(['code' => 1, 'msg' => '请选择隐藏项']);
        }
        try {
            MovieComment::whereIn('id', $ids)->update(['status' => 2]);
            return Response::json(['code' => 0, 'msg' => '隐藏成功']);
        } catch (\Exception $exception) {
            return Response::json(['code' => 1, 'msg' => '隐藏失败']);
        }
    }

    public function commentShow(Request $request)
    {
        MovieComment::where('id', $request->input('id') ?? 0)->update(['status' => 1]);
        return Response::json(['code' => 0, 'msg' => '回复显示成功']);
    }

    /**
     * 审核评论
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function commentAudit(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        MovieComment::where('id', $id)->update(['audit' => $status]);
        return Response::json(['code' => 0, 'msg' => '操作成功']);
    }

    public function add(Request $request)
    {
        $file = public_path('/comment_workers');
        $ids = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $workers = [];
        if (!empty($ids)) {
            $users = UserClient::whereIn('id', $ids)->get();
            foreach ($users as $user) {
                $workers[$user->id] = $user->email ? $user->email : $user->phone;
            }
        }
        if ($request->method() == 'GET') {
            return View::make('admin.comment.add', compact('workers'));
        }
        $number = $request->input('number');
        $uid = $request->input('uid');
        $comment = $request->input('comment');
        $movie = Movie::where('number', $number)->first();
        if (!$movie) {
            return Redirect::back()->withErrors('番号不存在');
        }
        MovieComment::insert(['comment' => $comment, 'mid' => $movie->id, 'uid' => $uid]);
        Movie::where('id', $movie->id)->update(['comment_num' => MovieComment::where('mid', $movie->id)->count(), 'new_comment_time' => date('Y-m-d H:i:s')]);
        return Redirect::to(URL::route('admin.movie.movie.commentList'))->with(['success' => '添加成功']);
    }

    public function edit(Request $request, $id)
    {
        $file = public_path('/comment_workers');
        $ids = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $workers = [];
        if (!empty($ids)) {
            $users = UserClient::whereIn('id', $ids)->get();
            foreach ($users as $user) {
                $workers[$user->id] = $user->email ? $user->email : $user->phone;
            }
        }
        if ($request->method() == 'GET') {
            $comment = MovieComment::where('movie_comment.id', $id)
                ->leftJoin('user_client', 'user_client.id', '=', 'movie_comment.uid')
                ->leftJoin('movie', 'movie.id', '=', 'movie_comment.mid')
                ->select('movie_comment.id', 'movie_comment.comment',
                    'movie.number', 'user_client.nickname as nickname')->first();
            return View::make('admin.comment.edit', compact('comment'));
        }
        $number = $request->input('number');
        $nickname = $request->input('nickname');
        $comment = $request->input('comment');
        $movie = Movie::where('number', $number)->first();
        if (!$movie) {
            return Redirect::back()->withErrors('番号不存在');
        }
        $user = UserClient::where('nickname', $nickname)->first();
        if (!$user) {
            return Redirect::back()->withErrors('用户不存在');
        }
        MovieComment::where('id', $id)->update(['comment' => $comment, 'mid' => $movie->id, 'uid' => $user->id]);
        return Redirect::to(URL::route('admin.movie.movie.commentList'))->with(['success' => '修改成功']);
    }

    public function reply(Request $request, $id)
    {
        $file = public_path('/comment_workers');
        $ids = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $workers = [];
        if (!empty($ids)) {
            $users = UserClient::whereIn('id', $ids)->get();
            foreach ($users as $user) {
                $workers[$user->id] = $user->email ? $user->email : $user->phone;
            }
        }
        if ($request->method() == 'GET') {
            $comment = MovieComment::where('movie_comment.id', $id)
                ->leftJoin('user_client', 'user_client.id', '=', 'movie_comment.uid')
                ->leftJoin('movie', 'movie.id', '=', 'movie_comment.mid')
                ->select('movie_comment.id', 'movie_comment.comment',
                    'movie.number', 'user_client.nickname as nickname')->first();
            return View::make('admin.comment.reply', compact('comment', 'workers'));
        }
        $number = $request->input('number');
        $uid = $request->input('uid');
        $reply = $request->input('reply');
        $movie = Movie::where('number', $number)->first();
        if (!$movie) {
            return Redirect::back()->withErrors('番号不存在');
        }
        $record = MovieComment::where('id', $id)->first();
        MovieComment::insert([
            'type' => 2,
            'comment' => $reply,
            'mid' => $movie->id,
            'reply_uid' => $record->uid,
            'cid' => $id,
            'uid' => $uid]);
        //更新评论统计数据
        $commentNum = MovieComment::where('mid', $movie->id)->where('status', 1)->count();
        Movie::where('id', $movie->id)->update([
            'comment_num' => $commentNum,
            'new_comment_time' => date('Y-m-d H:i:s', time())
        ]);
        RedisCache::clearCacheManageAllKey('movie');
        return Redirect::to(URL::route('admin.movie.movie.commentList'))->with(['success' => '回复成功']);
    }

    public function batchAdd(Request $request)
    {
        $batches = BatchComment::where('status', 0)->get();
        if ($request->method() == 'GET') {
            return View::make('admin.comment.batch', compact('batches'));
        }
        $file = $_FILES['list'];
        if (isset($file['type']) && $file['type'] !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            return Response::json(['code' => 1, 'msg' => '上传失败']);
        }
        $sheet_list = [];
        try {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow(); // 总行数
            $lines = $highestRow - 1;
            if ($lines <= 0) {
                return Response::json(['code' => 1, 'msg' => 'Excel表格中没有数据']);
            }
            for ($row = 2; $row <= $highestRow; ++$row) {
                $node = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $number = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $nickname = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $comment = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $sheet_list[] = [
                    'node' => trim($node),
                    'number' => trim($number),
                    'nickname' => trim($nickname),
                    'comment' => trim($comment)
                ];
            }
            BatchComment::insert([
                'data' => json_encode($sheet_list),
                'admin_id' => Auth::id(),
            ]);
        } catch (\Exception $e) {
            return Response::json(['code' => 1, 'msg' => '读取表格失败：' . $e->getMessage()]);
        }
        return Response::json(['code' => 0, 'msg' => '成功']);
    }

    public function workers(Request $request)
    {
        $file = public_path('/comment_workers');
        $ids = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($request->method() == 'GET') {
            $workers = [];
            if (!empty($ids)) {
                $users = UserClient::whereIn('id', $ids)->get();
                foreach ($users as $user) {
                    $workers[] = $user->email ? $user->email : $user->phone;
                }
            }
            $workers = join("\r\n", $workers);
            return View::make('admin.comment.workers', compact('workers'));
        }
        $list = $request->input('workers');
        $workers = explode("\r\n", $list);
        $ids = UserClient::whereIn('email', $workers)->orWhereIn('phone', $workers)->pluck('id')->all();
        $content = join("\r\n", $ids);
        file_put_contents($file, $content);
        return Redirect::to(URL::route('admin.movie.movie.commentList'))->with(['success' => '修改成功']);
    }
}

