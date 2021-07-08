<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectComment;
use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\MovieComment;
use App\Models\MovieDirector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReviewCommentController extends Controller
{
    /**
     * 评论采集
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.review_comment.index');
        }
        $model = CollectComment::query();
        $table = 'collection_comments';
        /*search*/
        $data = explode('~', $request->input('date'));
        if (isset($data[0]) && isset($data[1])) {
            $model = $model->whereBetween($table.'.created_at', [trim($data[0]), trim($data[1])]);
        }
        if($request->input('status')){
            $model = $model->where($table.'.status', $request->input('status'));
        }
        if($request->input('number')){
            $model = $model->where($table.'.number', $request->input('number'));
        }
        if($request->input('nickname')){
            $model = $model->where('users.nickname', $request->input('nickname'));
        }
        $res = $model->whereIn($table.'.status',[1,2])
            ->leftJoin('users', 'users.id', '=', $table.'.admin_id')
            ->orderBy($table.'.id', 'desc')
            ->select($table.'.*','users.nickname')
            ->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        if($request->method() == 'GET') {
            $comment = CollectComment::find($id);
            return View::make('admin.review_comment.edit', compact('comment'));
        }
        $data = $request->all();
        try {
            $movie = Movie::where('number',$data['number'])->first();
            if(!$movie){
                throw new \Exception('影片番号不存在');
            }
            CollectComment::where('id',$id)->update(['status' => 2,'admin_id'=>Auth::id()]);
            $collect = CollectComment::where('id',$id)->first();
            MovieComment::insert([
                'nickname'=>$data['user_name'],
                'source_type'=>3,
                'mid'=>$movie->id,
                'comment_time'=>$data['comment_time'],
                'comment'=>$data['comment'],
                'oid'=>$id,
                'collection_id' => $collect->collection_id
            ]);
            Movie::where('id',$movie->id)->update([
                'new_comment_time' => date('Y-m-d H:i:s'),
                'comment_num' => DB::raw('comment_num+1')]);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        return Redirect::to(URL::route('admin.review.comment'))->with(['success' => '更新成功']);
    }


}

