<?php

namespace App\Http\Controllers\Admin;

use App\Models\BatchComment;
use App\Models\MovieComment;
use App\Models\Movie;
use App\Models\MovieScoreNotes;
use App\Models\UserClient;
use App\Models\UserClientBlack;
use App\Models\UserLikeComment;
use App\Services\Logic\RedisCache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class NewCommentController extends Controller
{
    public function commentList(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.comment2.commentList');
        }

        $model = MovieComment::query();
        $model = $model->where('movie_comment.type', 1);
        $date = explode('~', $request->input('date'));
        if (isset($date[0]) && isset($date[1])) {
            $model = $model->whereBetween('movie.release_time', [trim($date[0]), trim($date[1])]);
        }
        if ($request->input('number')) {
            $model = $model->where('movie.number', $request->input('number'));
        }
        if ($request->input('uid')) {
            $model->where('movie_comment.uid',$request->input('uid'));
        }
        if ($request->input('nickname')) {
            $model->whereRaw('(user_client.nickname = \'' . $request->input('nickname') . '\' or movie_comment.nickname = \'' . $request->input('nickname') . '\')');
        }
        if (!is_null($request->input('silence')) && $request->input('silence') !== '') {
            $model = $model->where('user_client.status', $request->input('silence'));
        }
        if (!is_null($request->input('status')) && $request->input('status') !== '') {
            $model = $model->where('movie_comment.status', $request->input('status'));
        }
        if (!is_null($request->input('source_type')) && $request->input('source_type') !== '') {
            $model = $model->where('movie_comment.source_type', $request->input('source_type'));
        }

        $res = $model->orderBy('movie_comment.id', 'DESC')
            ->leftJoin('user_client', 'user_client.id', '=', 'movie_comment.uid')
            ->leftJoin('movie', 'movie.id', '=', 'movie_comment.mid')
            ->select('movie_comment.id', 'movie_comment.comment_time', 'movie_comment.score as score',
                'movie.number', 'movie.name as movie_name', 'movie_comment.comment as comment', 'movie_comment.type as type',
                'user_client.nickname as nickname', 'movie_comment.nickname as cnickname', 'movie_comment.source_type as source_type', 'movie_comment.uid as uid', 'movie_comment.audit as audit', 'movie_comment.status as status',
                'movie_comment.like','movie_comment.dislike','movie_comment.m_like','movie_comment.m_dislike'
            )
            ->paginate($request->get('limit', 30));

        foreach ($res as &$val) {
            $val->nickname = ($val->nickname ?? ($val->cnickname)) ?? '';
            $val->source_type = MovieComment::COMMENT_SORT_TYPE[$val->source_type] ?? '未知';
            if ($val->type != 1) {
                $val->score = '-';
            }
            $val->block = '';
            $user_block = UserClientBlack::where('uid',$val->uid)->first();
            if($user_block){
                $t = strtotime($user_block->unlock_time);
                if($t>time()+86400*365){
                    $val->block = '永久禁言';
                }else {
                    $val->block = '封禁至:' . date('Y-m-d', $t);
                }
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

    public function commentReplyList(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.comment2.commentReplyList');
        }
        $model = MovieComment::query();
        $model = $model->where('movie_comment.type', 2);
        $date = explode('~', $request->input('date'));
        if (isset($date[0]) && isset($date[1])) {
            $model = $model->whereBetween('movie.release_time', [trim($date[0]), trim($date[1])]);
        }
        if ($request->input('number')) {
            $model = $model->where('movie.number', $request->input('number'));
        }
        if ($request->input('uid')) {
            $model->where('movie_comment.uid',$request->input('uid'));
        }
        if ($request->input('nickname')) {
            $model->whereRaw('(user_client.nickname = \'' . $request->input('nickname') . '\' or movie_comment.nickname = \'' . $request->input('nickname') . '\')');
        }
        if (!is_null($request->input('silence')) && $request->input('silence') !== '') {
            $model = $model->where('user_client.status', $request->input('silence'));
        }
        if (!is_null($request->input('status')) && $request->input('status') !== '') {
            $model = $model->where('movie_comment.status', $request->input('status'));
        }
        if (!is_null($request->input('source_type')) && $request->input('source_type') !== '') {
            $model = $model->where('movie_comment.source_type', $request->input('source_type'));
        }

        $res = $model->orderBy('movie_comment.id', 'DESC')
            ->leftJoin('user_client', 'user_client.id', '=', 'movie_comment.uid')
            ->leftJoin('movie', 'movie.id', '=', 'movie_comment.mid')
            ->select('movie_comment.id', 'movie_comment.comment_time', 'movie_comment.score as score',
                'movie.number', 'movie.name as movie_name', 'movie_comment.comment as comment', 'movie_comment.type as type',
                'user_client.nickname as nickname', 'movie_comment.nickname as cnickname', 'movie_comment.source_type as source_type', 'movie_comment.uid as uid', 'movie_comment.audit as audit', 'movie_comment.status as status',
                'movie_comment.like','movie_comment.dislike','movie_comment.m_like','movie_comment.m_dislike'
            )
            ->paginate($request->get('limit', 30));

        foreach ($res as &$val) {
            $val->nickname = ($val->nickname ?? ($val->cnickname)) ?? '';
            $val->source_type = MovieComment::COMMENT_SORT_TYPE[$val->source_type] ?? '未知';
            if ($val->type != 1) {
                $val->score = '-';
            }
            $val->block = '';
            $user_block = UserClientBlack::where('uid',$val->uid)->first();
            if($user_block){
                $t = strtotime($user_block->unlock_time);
                if($t>time()+86400*365){
                    $val->block = '永久禁言';
                }else {
                    $val->block = '封禁至:' . date('Y-m-d', $t);
                }
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

    public function like(Request $request)
    {
        if ($request->method() == 'GET') {
            $id = $request->input('id');
            $comment = MovieComment::where('id',$id)->first();
            return View::make('admin.comment2.like',compact('id','comment'));
        }
        $id = $request->input('id');
        $res = UserLikeComment::join('user_client', 'user_client.id', '=', 'user_like_comment.uid')
            ->where(['user_like_comment.cid'=>$id,'user_like_comment.type'=>1])
            ->select('user_client.nickname','user_client.login_ip','user_like_comment.*')
            ->paginate($request->get('limit', 10));

        foreach ($res as &$val) {
            $val->block = '';
            $user_block = UserClientBlack::where('uid',$val->uid)->first();
            if($user_block){
                $t = strtotime($user_block->unlock_time);
                if($t>time()+86400*365){
                    $val->block = '永久禁言';
                }else {
                    $val->block = '封禁至:' . date('Y-m-d', $t);
                }
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

    public function reply(Request $request)
    {
        if ($request->method() == 'GET') {
            $id = $request->input('id');
            return View::make('admin.comment2.reply',compact('id'));
        }
        $id = $request->input('id');
        $res = MovieComment::join('user_client', 'user_client.id', '=', 'movie_comment.uid')
            ->where(['movie_comment.type'=>2,'movie_comment.cid'=>$id])
            ->select('movie_comment.*','user_client.nickname','user_client.login_ip')
            ->paginate($request->get('limit', 10));
        foreach ($res as &$val) {
            $val->block = '';
            $user_block = UserClientBlack::where('uid',$val->uid)->first();
            if($user_block){
                $t = strtotime($user_block->unlock_time);
                if($t>time()+86400*365){
                    $val->block = '永久禁言';
                }else {
                    $val->block = '封禁至:' . date('Y-m-d', $t);
                }
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

    public function commentShow(Request $request)
    {
        MovieComment::where('id', $request->input('id') ?? 0)->update(['status' => $request->input('status')]);
        return Response::json(['code' => 0, 'msg' => '回复显示成功']);
    }

    public function commentAddLike(Request $request)
    {
        $add = (int)$request->input('add');
        $record = MovieComment::where('id',$request->input('id'))->first();
        if($record->like > $add){
            return Response::json(['code' => 1, 'msg' => '加赞小于真实赞数']);
        }
        $m_like = $add - $record->like;
        MovieComment::where('id',$request->input('id'))->update(['m_like'=>$m_like]);
        return Response::json(['code' => 0, 'msg' => '加赞成功']);
    }

    public function getUserInfo(Request $request)
    {
        $record = UserClient::where('id',$request->input('id'))->first();
        return Response::json(['code' => 0, 'msg' => '成功', 'data' => $record]);
    }

    public function blockUser(Request $request)
    {
        $req = $request->all(['id','status','uid','uname','unlockday','remarks']);

        if($req['unlockday'] == 1){
            UserClientBlack::where('uid',$req['uid'])->delete();
            UserClient::where('id',$req['uid'])->update(['status'=>1]);
            $data = [
                'code'  => 0,
                'msg'   => '解除封禁',
            ];
            return \response()->json($data);
        }

        $mb = new UserClientBlack();
        //判断是否已经有
        $bid = $mb->check($req['uid']);
        if($bid>0)
        {
            $data = [
                'code'  => 100,
                'msg'   => '该用户已经被封禁',
            ];
            return \response()->json($data);
        }

        //读取用户id
        $user = UserClient::getOneById($req['uid']);

        if($user){
            //写入封禁表
            $mb->lock($req['uid'], $req['uname'],$user['phone'],$user['email'], $req['status'], $req['unlockday'],$req['remarks']);
            switch($req['unlockday'])
            {
                case 3:
                case 7:
                    MovieComment::where('id',$req['id'])->update(['status'=>2]);
                    break;
                case 30:
                case 99999:
                    MovieComment::where('uid',$req['uid'])->update(['status'=>2]);
                    break;
            }

            //修改用户表状态
            $muc = new UserClient();
            $muc->saveData($req['uid'],['status'=>$req['status']]);
        }

        $data = [
            'code'  => 0,
            'msg'   => '封禁成功',
        ];
        return \response()->json($data);
    }

    public function blockUsers(Request $request)
    {
        $req = $request->all(['ids','lock']);

        if($req['lock'] == 1){
            foreach ($req['ids'] as $id){
                UserClientBlack::where('uid',$id)->delete();
                UserClient::where('id',$id)->update(['status'=>1]);
            }
            $data = [
                'code'  => 0,
                'msg'   => '解除封禁',
            ];
            return \response()->json($data);
        }

        $mb = new UserClientBlack();
        foreach ($req['ids'] as $id) {
            if($mb->check($id) > 0){
                continue;
            }
            $user = UserClient::where('id',$id)->first();
            if ($user) {
                //写入封禁表
                $mb->lock($id, $user->nickname, $user->phone, $user->email, 2, $req['lock'], '');
                UserClient::where('id',$id)->update(['status'=>2]);
            }
        }

        $data = [
            'code'  => 0,
            'msg'   => '封禁成功',
        ];
        return \response()->json($data);
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
        if ($request->method() == 'GET') {
            return View::make('admin.comment2.add', compact('workers'));
        }
        $number = $request->input('number');
        $uid = $request->input('uid');
        $comment = $request->input('comment');
        $movie = Movie::where('number', $number)->first();
        if (!$movie) {
            return Redirect::back()->withErrors('番号不存在');
        }
        if(MovieComment::where(['mid'=>$movie->id, 'uid' => $uid,'type'=>1,'status'=>1])->exists()){
            return Redirect::back()->withErrors('已经发布过评论');
        }
        $score = rand(7, 10);
        MovieComment::insert(['comment' => $comment, 'mid' => $movie->id, 'uid' => $uid, 'score' => $score]);
        Movie::where('id', $movie->id)->update([
            'comment_num' => MovieComment::where('mid', $movie->id)->where('status', 1)->count(),
            'weight' => $movie->weight + 1,
            'new_comment_time' => date('Y-m-d H:i:s')]);
        //添加评分
        MovieScoreNotes::add($movie->id, $uid, $score);
        return Redirect::to(URL::route('admin.movie.movie.commentList'))->with(['success' => '添加成功']);
    }

    public function edit(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $comment = MovieComment::where('movie_comment.id', $id)
                ->leftJoin('user_client', 'user_client.id', '=', 'movie_comment.uid')
                ->leftJoin('movie', 'movie.id', '=', 'movie_comment.mid')
                ->select('movie_comment.id', 'movie_comment.comment',
                    'movie.number', 'user_client.nickname as nickname')->first();
            return View::make('admin.comment2.edit', compact('comment'));
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
}

