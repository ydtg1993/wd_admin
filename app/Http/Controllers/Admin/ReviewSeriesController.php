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
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.review_series.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = CollectSeries::whereIn('status',[1,2])->orderBy('id', 'desc')
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
        $categories = DB::table('movie_series_category')->pluck('name', 'id')->all();
        $series = CollectSeries::findOrFail($id);

        return View::make('admin.review_series.edit', compact('series', 'categories'));
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

