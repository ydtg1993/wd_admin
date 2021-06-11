<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectionMovie;
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
        $category = DB::table('movie_film_companies_category')->pluck( 'name','id');
        $categories = $category->all();
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
        $category = DB::table('movie_film_companies_category')->pluck( 'name','id');
        $categories = $category->all();
        $company = MovieFilmCompanies::leftJoin('movie_film_companies_category_associate','movie_film_companies.id','=','movie_film_companies_category_associate.film_companies_id')
            ->select('movie_film_companies.*','movie_film_companies_category_associate.film_companies_id','movie_film_companies_category_associate.cid')
            ->findOrFail($id);
        return View::make('admin.movie_companies.edit', compact('company','categories'));
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
        }catch (\Exception $e){
            return Redirect::back()->withErrors('更新失败:'.$e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.companies'))->with(['success' => '更新成功']);
    }



}

