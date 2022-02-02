<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use App\Models\MovieSeries;
use App\Models\MovieSeriesAss;
use App\Models\UserLikeSeries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MovieSeriesController extends Controller
{
    /**
     * 系列管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET') {
            $categories = DB::table('movie_series_category')->pluck( 'name','id');
            return View::make('admin.movie_series.index',compact('categories'));
        }

        $model = MovieSeries::query();
        $table = 'movie_series';
        /*search*/
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween($table.'.updated_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('name')){
            $model = $model->where($table.'.name', $request->input('name'));
        }
        if($request->input('category')){
            $model = $model->where('movie_series_category.name', $request->input('category'));
        }

        $res = $model->leftJoin('movie_series_category_associate',$table.'.id','=','movie_series_category_associate.series_id')
            ->join('movie_series_category','movie_series_category.id','=','movie_series_category_associate.cid')
            ->select($table.'.*','movie_series_category.name as category')
            ->orderBy($table.'.updated_at','desc')
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
     * 添加
     *  @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if($request->method() == 'GET') {
            $categories = DB::table('movie_series_category')->pluck( 'name','id')->all();
            return View::make('admin.movie_series.create',compact('categories'));
        }
        $data = $request->all();
        try{
            /*
            $id = MovieSeries::insertGetId(['name'=>$data['name'],'status'=>$data['status']]);
            */
            $id = MovieSeries::create($data['name'],$data['status']);
            $check = DB::table('movie_series_category_associate')->where('series_id',$id)->first();
            if($check){
                DB::table('movie_series_category_associate')->where(['id'=>$check->id])->update(['cid'=>$data['category']]);
            }else{
                DB::table('movie_series_category_associate')->insert(['series_id'=>$id,'cid'=>$data['category']]);
            }

            $numbers = explode("\r\n",$data['numbers']);
            $movie_ids = Movie::whereIn('number',$numbers)->pluck('id')->all();
            foreach ($movie_ids as $movie_id){
                //insert
                DB::table('movie_series_associate')->insert(['series_id'=>$id,'mid'=>$movie_id]);
            }
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('添加失败');
        }
        return Redirect::to(URL::route('admin.movie.series'))->with(['success'=>'添加成功']);
    }

    /**
     * 更新资讯
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        if($request->method() == 'GET') {
            $categories = DB::table('movie_series_category')->pluck( 'name','id')->all();
            $series = MovieSeries::leftJoin('movie_series_category_associate','movie_series.id','=','movie_series_category_associate.series_id')
                ->select('movie_series.*','movie_series_category_associate.series_id','movie_series_category_associate.cid')->findOrFail($id);
            /*关联影片*/
            $movie_ids = DB::table('movie_series_associate')->where('series_id',$id)->pluck('mid')->all();
            $numbers = Movie::whereIn('id',$movie_ids)->pluck('number');
            return View::make('admin.movie_series.edit', compact('series','categories','numbers'));
        }
        $data = $request->all();
        try {
            MovieSeries::where('id', $id)->update(['name' => $data['name'], 'status' => $data['status']]);
            /*分类*/
            $check = DB::table('movie_series_category_associate')->where('series_id',$id)->first();
            if($check){
                DB::table('movie_series_category_associate')->where(['id'=>$check->id])->update(['cid'=>$data['category']]);
            }else{
                DB::table('movie_series_category_associate')->insert(['series_id'=>$id,'cid'=>$data['category']]);
            }
            /*关联影片*/
            $has_movie_ids = DB::table('movie_series_associate')->where('series_id',$id)->pluck('mid')->all();
            $numbers = explode("\r\n",$data['numbers']);
            $movie_ids = Movie::whereIn('number',$numbers)->pluck('id')->all();
            foreach ($movie_ids as $movie_id){
                $index = array_search($movie_id,$has_movie_ids);
                if($index !== false){
                    array_splice($has_movie_ids,$index,1);
                    continue;
                }
                //insert
                DB::table('movie_series_associate')->insert(['series_id'=>$id,'mid'=>$movie_id]);
            }
            !empty($has_movie_ids) && DB::table('movie_series_associate')->where('series_id',$id)->whereIn('mid',$has_movie_ids)->delete();
        }catch (\Exception $e){
            return Redirect::back()->withErrors('更新失败:'.$e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.series'))->with(['success' => '更新成功']);
    }

    public function list(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_series.list');
        }
        if($request->method() == 'DELETE') {
            try {
                $id = $request->input('id');
                $ass = MovieSeriesAss::where('id', $id)->first();
                MovieSeriesAss::where('id', $id)->delete();

                $num = MovieSeriesAss::where('series_id',$ass->series_id)->count();
                MovieSeriesAss::where('id', $ass->series_id)->update(['movie_sum'=>$num]);
            }catch (\Exception $e){
                return Response::json(['code' => 1, 'msg' => $e->getMessage()]);
            }
            return Response::json(['code' => 0, 'msg' => '成功']);
        }

        $table = 'movie_series_associate.';
        $ass_id = 'series_id';

        $model = MovieSeriesAss::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('movie.release_time',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('number')){
            $model = $model->where('movie.number', $request->input('number'));
        }

        $res = $model->orderBy($table.'id', 'desc')
            ->join('movie_series','movie_series.id','=',$table.$ass_id)
            ->join('movie','movie.id','=',$table.'mid')
            ->leftJoin('movie_category_associate','movie_category_associate.mid','=',$table.'mid')
            ->leftJoin('movie_category','movie_category.id','=','movie_category_associate.cid')
            ->select(
                $table.'id',$table.'created_at',$table.'updated_at',
                'movie_series.name as series','movie_series.id as series_id',
                'movie.number','movie.name','movie.small_cover','movie.release_time','movie.score','movie_category.name as category')
            ->paginate($request->get('limit', 30));

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
        if($request->method() == 'GET') {
            return View::make('admin.movie_series.like');
        }
        $table = 'user_like_series.';
        $ass_id = 'series_id';
        $info_table = 'movie_series';

        $model = UserLikeSeries::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween($table.'.created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('name')){
            $model = $model->where($info_table.'.name', $request->input('name'));
        }
        if($request->input('nickname')){
            $model = $model->where('user_client.nickname', $request->input('nickname'));
        }

        $res = $model->orderBy($table.'id','DESC')
            ->join('user_client','user_client.id','=',$table.'uid')
            ->join($info_table,$info_table.'.id','=',$table.$ass_id)
            ->select($table.'id',$table.'like_time',
                $info_table.'.id as series_id',$info_table.'.name as series',
                'user_client.nickname')
            ->paginate($request->get('limit', 30));
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }
}

