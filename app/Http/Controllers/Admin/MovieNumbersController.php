<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use App\Models\Movienumber;
use App\Models\MovieNumberAss;
use App\Models\MovieNumbers;
use App\Models\UserLikeNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use mysql_xdevapi\Exception;

class MovieNumbersController extends Controller
{
    /**
     * 番号管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_numbers.index');
        }

        $model = MovieNumbers::query();
        /*search*/
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('name')){
            $model = $model->where('name', $request->input('name'));
        }
        if($request->input('category')){
            $model = $model->where('movie_series_category.name', $request->input('category'));
        }
        $res = $model->orderBy('id', 'desc')->paginate($request->get('limit', 30));

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
            return View::make('admin.movie_numbers.create');
        }
        $data = $request->all();
        try{
            $id = MovieNumbers::insertGetId(['name'=>$data['name'],'status'=>$data['status']]);

            $numbers = explode("\r\n",$data['number_list']);
            $movie_ids = Movie::whereIn('number',$numbers)->pluck('id')->all();
            foreach ($movie_ids as $movie_id){
                //insert
                DB::table('movie_number_associate')->insert(['nid'=>$id,'mid'=>$movie_id]);
            }
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('添加失败');
        }
        return Redirect::to(URL::route('admin.movie.numbers'))->with(['success'=>'添加成功']);
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
            $number = MovieNumbers::findOrFail($id);
            /*关联影片*/
            $movie_ids = DB::table('movie_number_associate')->where('nid',$id)->pluck('mid')->all();
            $number_list = Movie::whereIn('id',$movie_ids)->pluck('number');
            return View::make('admin.movie_numbers.edit', compact('number','number_list'));
        }
        $data = $request->all();
        try {
            MovieNumbers::where('id', $id)->update(['name' => $data['name'], 'status' => $data['status']]);
            /*关联影片*/
            $has_movie_ids = DB::table('movie_number_associate')->where('nid',$id)->pluck('mid')->all();
            $number_list = explode("\r\n",$data['number_list']);
            $movie_ids = Movie::whereIn('number',$number_list)->pluck('id')->all();
            foreach ($movie_ids as $movie_id){
                $index = array_search($movie_id,$has_movie_ids);
                if($index !== false){
                    array_splice($has_movie_ids,$index,1);
                    continue;
                }
                //insert
                DB::table('movie_number_associate')->insert(['nid'=>$id,'mid'=>$movie_id]);
            }
            !empty($has_movie_ids) && DB::table('movie_number_associate')->where('nid',$id)->whereIn('mid',$has_movie_ids)->delete();
        }catch (\Exception $e){
            return Redirect::back()->withErrors('更新失败:'.$e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.numbers'))->with(['success' => '更新成功']);
    }


    public function list(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_numbers.list');
        }
        if($request->method() == 'DELETE') {
            try {
                $id = $request->input('id');
                $ass = MovieNumberAss::where('id', $id)->first();
                MovieNumberAss::where('id', $id)->delete();

                $num = MovieNumberAss::where('nid',$ass->nid)->count();
                MovieNumbers::where('id', $ass->nid)->update(['movie_sum'=>$num]);
            }catch (\Exception $e){
                return Response::json(['code' => 1, 'msg' => $e->getMessage()]);
            }
            return Response::json(['code' => 0, 'msg' => '成功']);
        }

        $model = MovieNumberAss::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('movie.release_time',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('number')){
            $model = $model->where('movie.number', $request->input('number'));
        }
        $res = $model->orderBy('movie_number_associate.id', 'desc')
            ->join('movie_number','movie_number.id','=','movie_number_associate.nid')
            ->join('movie','movie.id','=','movie_number_associate.mid')
            ->leftJoin('movie_category_associate','movie_category_associate.mid','=','movie_number_associate.mid')
            ->leftJoin('movie_category','movie_category.id','=','movie_category_associate.cid')
            ->select(
                'movie_number_associate.id','movie_number_associate.created_at','movie_number_associate.updated_at',
                'movie_number.name as num',
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
            return View::make('admin.movie_numbers.like');
        }

        $model = UserLikeNumber::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('user_like_number.created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('nickname')){
            $model = $model->where('user_client.nickname', $request->input('nickname'));
        }
        $res =  $model->orderBy('id','DESC')
            ->join('user_client','user_client.id','=','user_like_number.uid')
            ->join('movie_number','movie_number.id','=','user_like_number.nid')
            ->select('user_like_number.id','user_like_number.like_time',
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

