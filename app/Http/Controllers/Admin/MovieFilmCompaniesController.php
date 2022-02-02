<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectionMovie;
use App\Models\Movie;
use App\Models\MovieFilmCompanies;
use App\Models\MovieFilmCompaniesAss;
use App\Models\UserLikeFilmCompanies;
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET') {
            $categories = DB::table('movie_film_companies_category')->pluck( 'name','id');
            return View::make('admin.movie_companies.index',compact('categories'));
        }

        $model = MovieFilmCompanies::query();
        $table = 'movie_film_companies';
        /*search*/
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween($table.'.updated_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('name')){
            $model = $model->where($table.'.name', $request->input('name'));
        }
        if($request->input('category')){
            $model = $model->where('movie_film_companies_category.name', $request->input('category'));
        }

        $res = $model->leftJoin('movie_film_companies_category_associate',$table.'.id','=','movie_film_companies_category_associate.film_companies_id')
            ->join('movie_film_companies_category','movie_film_companies_category.id','=','movie_film_companies_category_associate.cid')
            ->select($table.'.*','movie_film_companies_category.name as category')
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
            $categories = DB::table('movie_film_companies_category')->pluck( 'name','id')->all();
            return View::make('admin.movie_companies.create',compact('categories'));
        }
        $data = $request->all();
        try{
            /*
            $id = MovieFilmCompanies::insertGetId(['name'=>$data['name'],'status'=>$data['status']]);
            */
            $id = MovieFilmCompanies::create($data['name'],$data['status']);
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
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        if($request->method() == 'GET') {
            $categories = DB::table('movie_film_companies_category')->pluck( 'name','id')->all();
            $company = MovieFilmCompanies::leftJoin('movie_film_companies_category_associate','movie_film_companies.id','=','movie_film_companies_category_associate.film_companies_id')
                ->select('movie_film_companies.*','movie_film_companies_category_associate.film_companies_id','movie_film_companies_category_associate.cid')
                ->findOrFail($id);
            /*关联影片*/
            $movie_ids = DB::table('movie_film_companies_associate')->where('film_companies_id',$id)->pluck('mid')->all();
            $numbers = Movie::whereIn('id',$movie_ids)->pluck('number');
            return View::make('admin.movie_companies.edit', compact('company','categories','numbers'));
        }
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

    public function list(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_companies.list');
        }
        if($request->method() == 'DELETE') {
            try {
                $id = $request->input('id');
                $ass = MovieFilmCompaniesAss::where('id', $id)->first();
                MovieFilmCompaniesAss::where('id', $id)->delete();

                $num = MovieFilmCompaniesAss::where('film_companies_id',$ass->film_companies_id)->count();
                MovieFilmCompanies::where('id', $ass->film_companies_id)->update(['movie_sum'=>$num]);
            }catch (\Exception $e){
                return Response::json(['code' => 1, 'msg' => $e->getMessage()]);
            }
            return Response::json(['code' => 0, 'msg' => '成功']);
        }

        $table = 'movie_film_companies_associate.';
        $ass_id = 'film_companies_id';

        $model = MovieFilmCompaniesAss::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween($table.'.created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('number')){
            $model = $model->where('movie.number', $request->input('number'));
        }
        $res = $model->orderBy($table.'id', 'desc')
            ->join('movie_film_companies','movie_film_companies.id','=',$table.$ass_id)
            ->join('movie','movie.id','=',$table.'mid')
            ->leftJoin('movie_category_associate','movie_category_associate.mid','=',$table.'mid')
            ->leftJoin('movie_category','movie_category.id','=','movie_category_associate.cid')
            ->select(
                $table.'id',$table.'created_at',$table.'updated_at',
                'movie_film_companies.name as company','movie_film_companies.id as company_id',
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
            return View::make('admin.movie_companies.like');
        }
        $table = 'user_like_film_companies.';
        $ass_id = 'film_companies_id';
        $info_table = 'movie_film_companies';

        $model = UserLikeFilmCompanies::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('movie.release_time',[trim($date[0]),trim($date[1])]);
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
                $info_table.'.id as company_id',$info_table.'.name as company',
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

