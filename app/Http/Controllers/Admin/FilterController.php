<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Filter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Tools\RedisCache;

class FilterController extends Controller
{
    private $casheKey = 'filter_keyword';

    /**
     * 过滤词列表
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return View::make('admin.filter.index');
    }

    /**
     * 列表数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = [];
        if($request->input('keyword'))
        {
            $res = Filter::where('content',$request->input('keyword'))->get();
        }else{
            $res = Filter::get();
        }
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res->count(),
            'data'  => $res
        ];
        return Response::json($data);
    }

    /**
     * 添加
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.filter.create');
    }

    /**
     * 添加
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all(['content','adminer']);
        $data['adminer'] = $request->user()->username;

        $mdb = new Filter();
        $mdb->add($data);

        //清除缓存
        RedisCache::delKey($this->casheKey);

        return Redirect::to(URL::route('admin.user_client.filter'))->with(['success'=>'添加成功']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 更新
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $info = Filter::findOrFail($id);
        return View::make('admin.filter.edit',compact('info'));
    }

    /**
     * 更新
     * @param CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {        
        $da = $request->all(['content','adminer','id']);
        $da['adminer'] = $request->user()->username;

        $mdb = new Filter();
        $mdb->edit($da['id'],$da['content'],$da['adminer']);

        //清除缓存
        RedisCache::delKey($this->casheKey);

        return Redirect::to(URL::route('admin.user_client.filter'))->with(['success'=>'更新成功']);
    }

    /**
     * 删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $data = $request->all(['id']);

        $mdb = new Filter();
        $mdb->rm($data['id']);

        //清除缓存
        RedisCache::delKey($this->casheKey);

        return Response::json(['code'=>0,'msg'=>'删除成功']);
    }
}
