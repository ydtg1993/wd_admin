<?php

namespace App\Http\Controllers\Admin;

use App\Models\MovieLabelCategory;
use App\Models\MovieLabelCategoryAss;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Tools\RedisCache;

class MovieLabelClassController extends Controller
{
    /**
     * 标签管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET') {
            return View::make('admin.movie_label.class');
        }
        $model = MovieLabelCategory::where('status',1);

        if($request->input('name')){
            $model = $model->where('name','like', $request->input('name').'%');
        }
        $res = $model->orderBy('updated_at', 'desc')->paginate($request->get('limit', 30));
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
            return View::make('admin.movie_label.class_create');
        }
        $data = $request->all();
        try{
            MovieLabelCategory::create($data['name']);
        }catch (\Exception $exception){
            return Redirect::back()->withErrors('添加失败');
        }
        return Redirect::to(URL::route('admin.movie.label.class'))->with(['success'=>'添加成功']);
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
            $label = MovieLabelCategory::findOrFail($id);
            return View::make('admin.movie_label.class_edit', compact('label'));
        }
        $data = $request->all();
        try {
            MovieLabelCategory::where('id', $id)->update(['name' => $data['name']]);
            //清除前台的缓存列表
            RedisCache::delKey('label_classes');
        }catch (\Exception $e){
            return Redirect::back()->withErrors('更新失败:'.$e->getMessage());
        }
        return Redirect::to(URL::route('admin.movie.label.class'))->with(['success' => '更新成功']);
    }

    /**
     * 删除 
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        if($id<1){
            return Response::json(['code' => 1, 'msg' => '缺少id']);
        }

        //判断分类下面有内容，不可用删除
        $ass = MovieLabelCategoryAss::where('cid', $id)->where('status',1)->first();
        if($ass && isset($ass->id) && $ass->id>0){
            return Response::json(['code' => 1, 'msg' => '该分类下存在数据不能直接删除，请先移除分类下的标签']);
        }

        MovieLabelCategory::where('id', $id)->update(['status'=>2]);
        return Response::json(['code'=>0,'msg'=>'删除成功']);
    }
}

