<?php

namespace App\Http\Controllers\Admin;


use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\BatchComment;
use App\Models\Movie;
use App\Models\UserClient;
use App\Services\Logic\RedisCache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ArticleCommentController extends Controller
{
    public function commentList(Request $request)
    {
        if ($request->method() == 'GET') {
            $file = public_path('/comment_workers');
            if (!is_file($file)) {
                file_put_contents($file, '');
            }
            return View::make('admin.article_comment.commentList');
        }

        $model = ArticleComment::query();
        $date = explode('~', $request->input('date'));
        $model = $model->where('article_comment.status', '>', 0);//1是正常
        if (isset($date[0]) && isset($date[1])) {
            $model = $model->whereBetween('movie.release_time', [trim($date[0]), trim($date[1])]);
        }
        if ($request->input('title')) {
            $model = $model->where('articles.title','like', "%".$request->input('title')."%");
        }
        if ($request->input('nickname')) {
            $model->whereRaw('(user_client.nickname = \'' . $request->input('nickname') . '\' or article_comment.nickname = \'' . $request->input('nickname') . '\')');
        }
        if (!is_null($request->input('audit')) && $request->input('audit') !== '') {
            $model = $model->where('article_comment.audit', $request->input('audit'));
        }

        $res = $model->orderBy('article_comment.id', 'DESC')
            ->leftJoin('user_client', 'user_client.id', '=', 'article_comment.uid')
            ->leftJoin('articles', 'articles.id', '=', 'article_comment.aid')
            ->select('articles.title as title','article_comment.aid as aid',
                'article_comment.id', 'article_comment.comment_time', 'article_comment.comment as comment',
                'user_client.nickname as nickname',
                'article_comment.uid as uid', 'article_comment.audit as audit', 'article_comment.status as status')
            ->paginate($request->get('limit', 30));

        foreach ($res as &$val) {
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
        ArticleComment::where('id', $request->input('id') ?? 0)->update(['status' => 2]);
        return Redirect::to(URL::route('admin.article.commentList'))->with(['success' => '隐藏成功']);
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
            ArticleComment::whereIn('id', $ids)->update(['status' => 2]);
            return Response::json(['code' => 0, 'msg' => '隐藏成功']);
        } catch (\Exception $exception) {
            return Response::json(['code' => 1, 'msg' => '隐藏失败']);
        }
    }

    public function commentShow(Request $request)
    {
        ArticleComment::where('id', $request->input('id') ?? 0)->update(['status' => 1]);
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
        ArticleComment::where('id', $id)->update(['audit' => $status]);
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
            return View::make('admin.article_comment.add', compact('workers'));
        }
        $aid = $request->input('aid');
        $uid = $request->input('uid');
        $comment = $request->input('comment');
        $article = Article::where('id', $aid)->first();
        if (!$article) {
            return Redirect::back()->withErrors('话题不存在');
        }
        ArticleComment::insert(['comment' => $comment, 'aid' => $article->id, 'uid' => $uid]);
        return Redirect::to(URL::route('admin.article.commentList'))->with(['success' => '添加成功']);
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
            $comment = ArticleComment::where('article_comment.id', $id)
                ->leftJoin('user_client', 'user_client.id', '=', 'article_comment.uid')
                ->leftJoin('articles', 'articles.id', '=', 'article_comment.aid')
                ->select('article_comment.id', 'article_comment.comment',
                    'article_comment.aid', 'user_client.nickname as nickname')->first();
            return View::make('admin.article_comment.edit', compact('comment'));
        }
        $aid = $request->input('aid');
        $nickname = $request->input('nickname');
        $comment = $request->input('comment');
        $article = Article::where('id', $aid)->first();
        if (!$article) {
            return Redirect::back()->withErrors('话题不存在');
        }
        $user = UserClient::where('nickname', $nickname)->first();
        if (!$user) {
            return Redirect::back()->withErrors('用户不存在');
        }
        ArticleComment::where('id', $id)->update(['comment' => $comment, 'aid' => $article->id, 'uid' => $user->id]);
        return Redirect::to(URL::route('admin.article.commentList'))->with(['success' => '修改成功']);
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
            $comment = ArticleComment::where('article_comment.id', $id)
                ->leftJoin('user_client', 'user_client.id', '=', 'article_comment.uid')
                ->leftJoin('articles', 'articles.id', '=', 'article_comment.aid')
                ->select('article_comment.id', 'article_comment.comment',
                    'article_comment.aid as aid', 'user_client.nickname as nickname')->first();
            return View::make('admin.article_comment.reply', compact('comment', 'workers'));
        }
        $aid = $request->input('aid');
        $uid = $request->input('uid');
        $reply = $request->input('reply');
        $article = Article::where('id', $aid)->first();
        if (!$article) {
            return Redirect::back()->withErrors('话题不存在');
        }
        $record = ArticleComment::where('id', $id)->first();
        ArticleComment::insert([
            'type' => 2,
            'comment' => $reply,
            'aid' => $article->id,
            'reply_uid' => $record->uid,
            'cid' => $id,
            'uid' => $uid]);
        return Redirect::to(URL::route('admin.article.commentList'))->with(['success' => '回复成功']);
    }

    public function batchAdd(Request $request)
    {
        $batches = BatchComment::where('status', 0)->where('type',1)->get();
        if ($request->method() == 'GET') {
            return View::make('admin.article_comment.batch', compact('batches'));
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
                $account = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $comment = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $sheet_list[] = [
                    'node' => trim($node),
                    'number' => trim($number),
                    'account' => trim($account),
                    'comment' => trim($comment)
                ];
            }
            BatchComment::insert([
                'data' => json_encode($sheet_list),
                'admin_id' => Auth::id(),
                'type' => 1
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
            return View::make('admin.article_comment.workers', compact('workers'));
        }
        $list = $request->input('workers');
        $workers = explode("\r\n", $list);
        $ids = UserClient::whereIn('email', $workers)->orWhereIn('phone', $workers)->pluck('id')->all();
        $content = join("\r\n", $ids);
        file_put_contents($file, $content);
        return Redirect::to(URL::route('admin.article.commentList'))->with(['success' => '修改成功']);
    }
}

