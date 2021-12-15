<?php

namespace App\Http\Controllers\Admin;

use App\Models\MovieActor;
use App\Models\MovieDirector;
use App\Models\MovieDirectorAss;
use App\Models\UserLikeDirector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MovieDirectorController extends Controller
{
    /**
     * 导演
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_director.index');
        }
        $model = MovieDirector::query();
        /*search*/
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('name')){
            $model = $model->where('name', $request->input('name'));
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_director.create');
        }
        $data = $request->all();
        try {
            /*
            MovieDirector::insert(['name'=>$data['name'],'status'=>$data['status']??1]);
            */
            MovieDirector::create($data['name'],1);
        } catch (\Exception $exception) {
            return Redirect::back()->withErrors('添加失败 ' . $exception->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.director'))->with(['success' => '添加成功']);
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
            $director = MovieDirector::findOrFail($id);
            return View::make('admin.movie_director.edit', compact('director'));
        }
        $data = $request->all();
        try {
            MovieDirector::where('id',$id)->update(['name'=>$data['name'],'status'=>$data['status']??1]);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.director'))->with(['success' => '更新成功']);
    }

    public function list(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_director.list');
        }
        if($request->method() == 'DELETE') {
            try {
                $id = $request->input('id');
                $ass = MovieDirectorAss::where('id', $id)->first();
                MovieDirectorAss::where('id', $id)->delete();

                $num = MovieDirectorAss::where('did',$ass->did)->count();
                MovieDirector::where('id', $ass->did)->update(['movie_sum'=>$num]);
            }catch (\Exception $e){
                return Response::json(['code' => 1, 'msg' => $e->getMessage()]);
            }
            return Response::json(['code' => 0, 'msg' => '成功']);
        }

        $model = MovieDirectorAss::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('movie.release_time',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('number')){
            $model = $model->where('movie.number', $request->input('number'));
        }
        $res = $model->orderBy('movie_director_associate.id', 'desc')
            ->join('movie_director','movie_director.id','=','movie_director_associate.did')
            ->join('movie','movie.id','=','movie_director_associate.mid')
            ->leftJoin('movie_category_associate','movie_category_associate.mid','=','movie_director_associate.mid')
            ->leftJoin('movie_category','movie_category.id','=','movie_category_associate.cid')
            ->select(
                'movie_director_associate.id','movie_director_associate.created_at',
                'movie_director.name as director','movie_director.id as director_id',
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
            return View::make('admin.movie_director.like');
        }
        $res = UserLikeDirector::orderBy('user_like_director.id','DESC')
            ->join('user_client','user_client.id','=','user_like_director.uid')
            ->join('movie_director','movie_director.id','=','user_like_director.did')
            ->select('user_like_director.id','user_like_director.like_time',
                'movie_director.id as director_id','movie_director.name as director',
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

