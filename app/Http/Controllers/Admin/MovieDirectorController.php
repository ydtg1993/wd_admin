<?php

namespace App\Http\Controllers\Admin;

use App\Models\MovieActor;
use App\Models\MovieDirector;
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
     * 影片演员管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.movie_director.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = MovieDirector::orderBy('id', 'desc')->paginate($request->get('limit', 30));

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
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.movie_director.create');
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            MovieDirector::insert(['name'=>$data['name'],'status'=>$data['status']]);
        } catch (\Exception $exception) {
            return Redirect::back()->withErrors('添加失败 ' . $exception->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.director'))->with(['success' => '添加成功']);
    }

    /**
     * 更新
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $director = MovieDirector::findOrFail($id);
        return View::make('admin.movie_director.edit', compact('director'));
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
            MovieDirector::where('id',$id)->update(['name'=>$data['name'],'status'=>$data['status']]);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.director'))->with(['success' => '更新成功']);
    }

    public function list(Request $request)
    {

    }

    public function like(Request $request)
    {

    }
}

