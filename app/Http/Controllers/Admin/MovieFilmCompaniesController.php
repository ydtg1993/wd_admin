<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectionMovie;
use App\Models\Movie;
use App\Models\MovieFilmCompanies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MovieFilmCompaniesController extends Controller
{
    /**
     * 片商管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.movie_companies.index');
    }

    /**
     * 资讯数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $category = DB::table('movie_film_companies_category')->pluck( 'name','id');

        $res = MovieFilmCompanies::orderBy('id', 'desc')
            ->leftJoin('movie_film_companies_category_associate','movie_film_companies.id','=','movie_film_companies_category_associate.film_companies_id')
            ->select('movie_film_companies.*','movie_film_companies_category_associate.film_companies_id','movie_film_companies_category_associate.cid')
            ->paginate($request->get('limit', 30));
        $records = $res->toArray();
        foreach ($records['data'] as &$record){
            $record['category'] = '';
            if(isset($category->all()[$record['cid']])){
                $record['category'] = $category->all()[$record['cid']];
            }
        }

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $records['data'],
        ];
        return Response::json($data);
    }

    /**
     * 添加分类
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = DB::table('movie_film_companies_category')->pluck( 'name','id')->all();
        return View::make('admin.movie_companies.create',compact('categories'));
    }

    /**
     * 添加分类
     *  @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try{
            $id = MovieFilmCompanies::insertGetId(['name'=>$data['name'],'status'=>$data['status']]);
            $check = DB::table('movie_film_companies_category_associate')->where(['film_companies_id'=>$id])->first();
            if($check){
                DB::table('movie_film_companies_category_associate')->where('id',$check->id)->update(['cid'=>$data['category']]);
            }else{
                DB::table('movie_film_companies_category_associate')->insert(['film_companies_id'=>$id,'cid'=>$data['category']]);
            }

            $numbers = explode("\r\n",$data['numbers']);
            $movie_ids = Movie::whereIn('number',$numbers)->pluck('id')->all();
            foreach ($movie_ids as $movie_id){
                DB::table('movie_film_companies_associate')->insert(['film_companies_id'=>$id,'mid'=>$movie_id]);
            }
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('添加失败');
        }
        return Redirect::to(URL::route('admin.movie.companies'))->with(['success'=>'添加成功']);
    }

    /**
     * 更新资讯
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $categories = DB::table('movie_film_companies_category')->pluck( 'name','id')->all();
        $company = MovieFilmCompanies::leftJoin('movie_film_companies_category_associate','movie_film_companies.id','=','movie_film_companies_category_associate.film_companies_id')
            ->select('movie_film_companies.*','movie_film_companies_category_associate.film_companies_id','movie_film_companies_category_associate.cid')
            ->findOrFail($id);
        /*关联影片*/
        $movie_ids = DB::table('movie_film_companies_associate')->where('film_companies_id',$id)->pluck('mid')->all();
        $numbers = Movie::whereIn('id',$movie_ids)->pluck('number');
        return View::make('admin.movie_companies.edit', compact('company','categories','numbers'));
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
            MovieFilmCompanies::where('id', $id)->update(['name' => $data['name'], 'status' => $data['status']]);
            $check = DB::table('movie_film_companies_category_associate')->where(['film_companies_id'=>$id])->first();
            if($check){
                DB::table('movie_film_companies_category_associate')->where('id',$check->id)->update(['cid'=>$data['category']]);
            }else{
                DB::table('movie_film_companies_category_associate')->insert(['film_companies_id'=>$id,'cid'=>$data['category']]);
            }
            /*关联影片*/
            $has_movie_ids = DB::table('movie_film_companies_associate')->where('film_companies_id',$id)->pluck('mid')->all();
            $numbers = explode("\r\n",$data['numbers']);
            $movie_ids = Movie::whereIn('number',$numbers)->pluck('id')->all();
            foreach ($movie_ids as $movie_id){
                $index = array_search($movie_id,$has_movie_ids);
                if($index !== false){
                    array_splice($has_movie_ids,$index,1);
                    continue;
                }
                //insert
                DB::table('movie_film_companies_associate')->insert(['film_companies_id'=>$id,'mid'=>$movie_id]);
            }
            !empty($has_movie_ids) && DB::table('movie_film_companies_associate')->where('film_companies_id',$id)->whereIn('mid',$has_movie_ids)->delete();
        }catch (\Exception $e){
            return Redirect::back()->withErrors('更新失败:'.$e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.companies'))->with(['success' => '更新成功']);
    }



}

