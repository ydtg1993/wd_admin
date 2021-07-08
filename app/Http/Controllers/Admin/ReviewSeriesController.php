<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectSeries;
use App\Models\MovieSeries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReviewSeriesController extends Controller
{
    /**
     * 采集演员管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET'){
            return View::make('admin.review_series.index');
        }

        $model = CollectSeries::query();
        $table = 'collection_series';
        /*search*/
        $data = explode('~', $request->input('date'));
        if (isset($data[0]) && isset($data[1])) {
            $model = $model->whereBetween($table.'.created_at', [trim($data[0]), trim($data[1])]);
        }
        if($request->input('status')){
            $model = $model->where($table.'.status', $request->input('status'));
        }
        if($request->input('name')){
            $model = $model->where($table.'.name', $request->input('name'));
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
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request,$id)
    {
        if($request->method() == 'GET') {
            $categories = DB::table('movie_series_category')->pluck('name', 'id')->all();
            $series = CollectSeries::findOrFail($id);

            return View::make('admin.review_series.edit', compact('series', 'categories'));
        }
        $data = $request->all();
        try {
            $series = MovieSeries::where('name',$data['name'])->get();
            foreach ($series as $serie){
                if(DB::table('movie_series_category_associate')
                    ->where(['series_id'=>$serie->id,'cid'=>$data['category']])
                    ->exists()){
                    throw new \Exception('系列重复');
                }
            }

            CollectSeries::where('id', $id)->update(['status' =>2,'admin_id'=>Auth::id()]);
            $series_id = MovieSeries::insertGetId(['name'=>$data['name'],'oid'=>$id]);
            /*category*/
            DB::table('movie_series_category_associate')->insert(['series_id'=>$series_id,'cid'=>$data['category']]);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        return Redirect::to(URL::route('admin.review.series'))->with(['success' => '更新成功']);
    }


}

