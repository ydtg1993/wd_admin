<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use App\Models\Movienumber;
use App\Models\MovieNumbers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MovieNumbersController extends Controller
{
    /**
     * 系列管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.movie_numbers.index');
    }

    /**
     * 资讯数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = MovieNumbers::orderBy('id', 'desc')->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    /**
     * 添加分类
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.movie_numbers.create');
    }

    /**
     * 添加
     *  @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
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
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $number = MovieNumbers::findOrFail($id);
        /*关联影片*/
        $movie_ids = DB::table('movie_number_associate')->where('nid',$id)->pluck('mid')->all();
        $number_list = Movie::whereIn('id',$movie_ids)->pluck('number');
        return View::make('admin.movie_numbers.edit', compact('number','number_list'));
    }

    /**
     * 更新资讯
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
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



}

