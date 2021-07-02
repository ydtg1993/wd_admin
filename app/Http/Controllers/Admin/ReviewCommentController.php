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
     * 采集管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.review_comment.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = CollectComment::where('status',1)->orderBy('id', 'desc')
            ->paginate($request->get('limit', 30));
        $records = $res->toArray();

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $records['data'],
        ];
        return Response::json($data);
    }

    /**
     * 更新
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $comment = CollectComment::find($id);
        return View::make('admin.review_comment.edit', compact('comment'));
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
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

