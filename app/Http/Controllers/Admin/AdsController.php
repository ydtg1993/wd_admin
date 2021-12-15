<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\AdsList;
use App\Models\AdsLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Tools\RedisCache;

class AdsController extends Controller
{
    private $casheKey = 'ads_list';

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
        $locationTy = $this->locationTy;

        //读取广告位列表
        $location = AdsLocation::select("location")->get();

        $ty = array();
        foreach($location as $k=>$v)
        {
            $ty[$v->location] = isset($locationTy[$v->location])?$locationTy[$v->location]:$v->location;
        }

        return View::make('admin.ads.index',compact('ty'));
    }

    /**
     * 列表数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $model = AdsList::query();
        $date = explode('~', $request->input('date'));
        if (isset($date[0]) && isset($date[1])) {
            $model = $model->whereBetween('end_time', [trim($date[0]), trim($date[1])]);
        }
        if ($request->input('id')) {
            $model = $model->where('id', $request->input('id'));
        }
        if ($request->input('name')) {
            $model = $model->where('name', $request->input('name'));
        }
        if ($request->input('location')) {
            $model = $model->where('location', $request->input('location'));
        }
        if ($request->input('status')) {
            $model = $model->where('status', $request->input('status'));
        } 

        $res = $model->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($request->get('limit',20));

        if (count($res->items()) >0 ){
            foreach ($res->items() as $k=>$v){
                switch ($res->items()[$k]->status)
                {
                    case 1:
                        $res->items()[$k]->status = '上架中';
                        break;
                    case 2:
                        $res->items()[$k]->status = '下架';
                        break;
                    case 3:
                        $res->items()[$k]->status = '到期';
                        break;
                }
                //有效时间
                $res->items()[$k]->start_time = $res->items()[$k]->start_time.'~'.$res->items()[$k]->end_time;

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
        $locationTy = $this->locationTy;

        //读取广告位列表
        $location = AdsLocation::select("location")->get();

        $ty = array();
        foreach($location as $k=>$v)
        {
            $ty[$v->location] = isset($locationTy[$v->location])?$locationTy[$v->location]:$v->location;
        }

        return View::make('admin.ads.create',compact('ty'));
    }

    /**
     * 添加
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all(['name','remark','location','photo','url','start_time','end_time','sort','is_close','status']);
        $data['adminer'] = $request->user()->username;

        $data['sort'] = intval($data['sort']);

        if(!$data['name'])
        {
            $data = [
                'code'  => 100,
                'msg'   => '广告名称必填',
            ];
            return \response()->json($data);
        }

        //判断结束时间小于当前时间，到期
       if(strtotime($data['end_time'])<time())
       {
            $data['status'] = 3; 
       }

        $mdb = new AdsList();
        $mdb->add($data);

        //清除缓存
        RedisCache::delKey($this->casheKey.':'.$data['location']);

        return Redirect::to(URL::route('admin.ads.list.index'))->with(['success'=>'添加成功']);
    }

    /**
     * 更新
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $locationTy = $this->locationTy;

        //读取广告位列表
        $location = AdsLocation::select("location")->get();

        $ty = array();
        foreach($location as $k=>$v)
        {
            $ty[$v->location] = isset($locationTy[$v->location])?$locationTy[$v->location]:$v->location;
        }

        $info = AdsList::findOrFail($id);

        return View::make('admin.ads.edit',compact('info','ty'));
    }

    /**
     * 更新
     * @param CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {        
        $data = $request->all(['name','remark','location','photo','url','start_time','end_time','sort','is_close','status']);
        $data['adminer'] = $request->user()->username;

       //判断结束时间小于当前时间，到期
       if(strtotime($data['end_time'])<time())
       {
            $data['status'] = 3; 
       }

        $mdb = new AdsList();
        $mdb->edit($data,intval($request->input('id')));

        //清除缓存
        RedisCache::delKey($this->casheKey.':'.$data['location']);

        return Redirect::to(URL::route('admin.ads.list.index'))->with(['success'=>'更新成功']);
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

        $mdb = new AdsList();
        $mdb->edit($da,$id);

        //读取
        $data = AdsList::select('id','location')->where('id',$id)->first();

        //清除缓存
        RedisCache::delKey($this->casheKey.':'.$data['location']);

        return Response::json(['code'=>0,'msg'=>'操作成功']);
    }

    /**
     * 删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function del(Request $request)
    {

        $id = intval($request->input('id'));

        //读取
        $data = AdsList::select('id','location')->where('id',$id)->first();

        //清除缓存
        RedisCache::delKey($this->casheKey.':'.$data['location']);

        $mdb = new AdsList();
        $mdb->del($id);

        return Response::json(['code'=>0,'msg'=>'操作成功']);
    }

}
