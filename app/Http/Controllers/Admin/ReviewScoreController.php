<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectComment;
use App\Models\CollectScore;
use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\MovieComment;
use App\Models\MovieDirector;
use App\Models\MovieScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReviewScoreController extends Controller
{
    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.review_score.index');
        }
        $model = CollectScore::query();
        $table = 'collection_score';
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
        if($request->input('score')){
            $model = $model->where($table.'.score', $request->input('score'));
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
            $score = CollectScore::find($id);
            return View::make('admin.review_score.edit', compact('score'));
        }
        $data = $request->all();
        try {
            $movie = Movie::where('number', $data['number'])->first();
            if (!$movie) {
                throw new \Exception('影片番号不存在');
            }
            CollectScore::where('id', $id)->update(['status' => 2, 'admin_id' => Auth::id()]);
            $collect = CollectScore::where('id', $id)->first();
            MovieScore::insert([
                'nickname' => $data['user_name'],
                'source_type' => 3,
                'mid' => $movie->id,
                'score_time' => $data['content_time'],
                'score' => $data['score'],
                'oid' => $id,
                'collection_id' => $collect->collection_id
            ]);
            Movie::where('id', $movie->id)->update([
                'new_comment_time' => date('Y-m-d H:i:s'),
                'collection_score_people' => DB::raw('collection_score_people+1'),
                'collection_score' => $data['score']
            ]);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        return Redirect::to(URL::route('admin.review.score'))->with(['success' => '更新成功']);
    }


}

