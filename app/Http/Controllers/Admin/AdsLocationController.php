<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\AdsLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Tools\RedisCache;

class AdsLocationController extends Controller
{
    private $locationTy = [
        'left'=>'对联-左',
        'right'=>'对联-右',
        'top'=>'网站顶部',
        'foot'=>'网站底部'
    ];

    /**
     * 过滤词列表
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return View::make('admin.ads.location');
    }

    /**
     * 列表数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $res = AdsLocation::select('id','name','location','status')->orderBy('id','asc')->paginate($request->get('limit',20));

        if (count($res->items()) >0 ){
            foreach ($res->items() as $k=>$v){
                $res->items()[$k]->status = ($res->items()[$k]->status==1)?'启用':'关闭';
                $res->items()[$k]->location = isset($this->locationTy[$res->items()[$k]->location])?$this->locationTy[$res->items()[$k]->location]:$res->items()[$k]->location;
            }
        }

        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res->total(),
            'data'  => $res->items()
        ];
        return Response::json($data);
    }

    /**
     * 添加
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $location = $this->locationTy;
        return View::make('admin.ads.location_create',compact('location'));
    }

    /**
     * 添加
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all(['name','location']);
        $data['status'] = 1 ;

        $mdb = new AdsLocation();
        $mdb->add($data);

        return Redirect::to(URL::route('admin.ads.location.index'))->with(['success'=>'添加成功']);
    }

    /**
     * 更新
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $info = AdsLocation::findOrFail($id);
        return View::make('admin.ads.location_edit',compact('info'));
    }

    /**
     * 更新
     * @param CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {        
        $da = $request->all(['name','location']);
       
        $mdb = new AdsLocation();
        $mdb->edit($da,intval($request->input('id')));

        return Redirect::to(URL::route('admin.ads.location.index'))->with(['success'=>'更新成功']);
    }

    /**
     * 启用
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request)
    {
        $da = $request->all(['status']);

        $id = intval($request->input('id'));

        $mdb = new AdsLocation();
        $mdb->edit($da,$id);

        return Response::json(['code'=>0,'msg'=>'操作成功']);
    }
}
