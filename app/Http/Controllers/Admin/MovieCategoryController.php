<?php

namespace App\Http\Controllers\Admin;

use App\Models\MovieActor;
use App\Models\MovieCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class MovieCategoryController extends Controller
{
    /**
     * 影片分类管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.movie_category.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = MovieCategory::orderBy('id', 'desc')->paginate($request->get('limit', 30));
        $records = $res->toArray();
        foreach ($records['data'] as &$record){
            $record['movie_sum'] = DB::table('movie_category_associate')->where('cid',$record['id'])->count();
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
     * 添加
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.movie_category.create');
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
            if(MovieCategory::where('name',$data['name'])->exists()){
                throw new \Exception("名字重复");
            }
            MovieCategory::insert([
               'name'=>$data['name'],
               'status'=>$data['status']
            ]);
        } catch (\Exception $exception) {
            return Redirect::back()->withErrors('添加失败 ' . $exception->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.category'))->with(['success' => '添加成功']);
    }

    /**
     * 更新
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $category = MovieCategory::where('id',$id)->first();
        return View::make('admin.movie_category.edit',compact('category'));
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
            MovieCategory::where('id',$id)->update(['status'=>$data['status']]);
        } catch (\Exception $e) {
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.category'))->with(['success' => '更新成功']);
    }


}

