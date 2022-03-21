<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UseClientRequest;
use App\Models\Report;
use App\Models\UserClient;
use App\Models\UserClientBlack;
use App\Tools\UserTool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class UserClientController extends Controller
{
    /**
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.user_client.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $data = $request->all(['created_at_start','created_at_end','status','type','reg_device','u_number','u_nickname','u_phone','u_email']);

        $res = UserClient::when($data['type'],function ($query,$data) {
                return $query->where('user_client.type',$data);
            })->when($data['status'],function ($query,$data) {
                return $query->where('user_client.status',$data);
            })->when($data['reg_device'],function ($query,$data) {
                return $query->where('user_client.reg_device',$data);
            }) ->when($data['u_number'],function ($query,$data) {
                //查询用户id
                return $query->where('user_client.number','like',$data.'%');
            })->when($data['u_nickname'],function ($query,$data) {
                //查询用户昵称/用户名
                return $query->where('user_client.nickname','like',$data.'%');
            })->when($data['u_phone'],function ($query,$data) {
                //查询用户号码
                return $query->where('user_client.phone','like',$data.'%');
            })->when($data['u_email'],function ($query,$data) {
                //查询用户邮箱
                return $query->where('user_client.email','like',$data.'%');
            })->when($data['created_at_start'],function ($query,$data){
                return $query->where('user_client.created_at','>=',$data);
            })->when($data['created_at_end'],function ($query,$data){
                return $query->where('user_client.created_at','<=',$data);
            })->leftjoin('user_client_event','user_client.id','=','user_client_event.uid')
                ->select('user_client.*','user_client_event.reply','user_client_event.like',
                'user_client_event.my_comment',
                'user_client_event.my_reply','user_client_event.my_like','user_client_event.dislike',
                    'user_client_event.report')
            ->orderBy('user_client.id','desc')->paginate($request->get('limit',30));
        $statusMap = [
            1=>'正常',
            2=>'已禁言',
            3=>'已拉黑',
        ];
        $typeMap = [
            1=>'普通用户',
            2=>'运营用户',
            3=>'vip用户',
        ];
        if (count($res->items()) >0 ){
            foreach ($res->items() as $k=>$v){
                $res->items()[$k]->status = $statusMap[$res->items()[$k]->status];
                $res->items()[$k]->type = $typeMap[$res->items()[$k]->type];
            }
        }
        $data = [
            'code' => 0,
            'msg'   => '正在请求中...',
            'count' => $res->total(),
            'data'  => $res->items(),
        ];
        return Response::json($data);
    }



    /**
     * top
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return View::make('admin.user_client.create');
    }

    /**
     * top
     * @param  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UseClientRequest $request)
    {
        $data = $request->all();
        try{
            //唯一性验证
            if(UserClient::checkEmail($data['email'])){
                return Redirect::back()->withErrors('邮箱账户已存在');
            }

            $data['pwd'] = UserTool::encodePwd($data['pwd']);
            UserClient::createData( $data );
//            $article->tags()->sync($request->get('tags',[]));
            return Redirect::to(URL::route('admin.user_client.index'))->with(['success'=>'添加成功']);
        }catch (\Exception $exception){
            Log::error('store user:'.$exception->getFile().$exception->getLine().$exception->getMessage());
            return Redirect::back()->withErrors('添加失败');
        }
    }

    /**
     * edit top
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id): \Illuminate\Contracts\View\View
    {
        $userClient = UserClient::getOneById( $id );
        return View::make('admin.user_client.edit',compact('userClient'));
    }

    /**
     * @param UseClientRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UseClientRequest $request, $id)
    {
        $data = $request->all();
        try{
            //唯一性验证
            if(UserClient::checkEmailNotMe($data['email'],$id)){
                return Redirect::back()->withErrors('邮箱账户已存在');
            }
            (new \App\Models\UserClient)->saveData($id,$data);
            return Redirect::to(URL::route('admin.user_client.index'))->with(['success'=>'更新成功']);
        }catch (\Exception $exception){
            Log::error('store user:'.$exception->getFile().$exception->getLine().$exception->getMessage());
            return Redirect::back()->withErrors('更新失败');
        }
    }

    public function destroy( Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->destroyCommon($request);
    }

    /**
     * 封禁用户
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function blockUser(Request $request ): \Illuminate\Http\JsonResponse
    {

        $req = $request->all(['uid','uname','status','unlockday','remarks']);

        $mb = new UserClientBlack();
        //判断是否已经有
        $bid = $mb->check($req['uid']);
        if($bid>0)
        {
            $data = [
                'code'  => 100,
                'msg'   => '该用户已经被封禁',
            ];
            return \response()->json($data);
        }

        //读取用户id
        $user = UserClient::getOneById($req['uid']);

        if($user){
            //写入封禁表
            $mb->lock($req['uid'], $req['uname'],$user['phone'],$user['email'], $req['status'], $req['unlockday'],$req['remarks']);

            //修改用户表状态
            $muc = new UserClient();
            $muc->saveData($req['uid'],['status'=>$req['status']]);
        }

        $data = [
                'code'  => 0,
                'msg'   => '封禁成功',
            ];
        return \response()->json($data);
    }

    /**
     * 封禁批量操作 
     */
    public function blockUserAll(Request $request):\Illuminate\Http\JsonResponse
    {
        $req = $request->all(['uid','uname','status','unlockday','remarks']);

        //加工数据
        $uids = $req['uid'];
        $uidArr = explode(',',$uids);

        $unames = $req['uname'];
        $unameArr = explode(',',$unames);

        $mb = new UserClientBlack();
        $muc = new UserClient();

        //循环插入数据
        foreach($uidArr as $k=>$v)
        {
            //判断是否已经有
            $bid = $mb->check($v);
            if($bid<1){
                //客户信息
                $user = UserClient::getOneById($v);

                //写入封禁表
                $mb->lock($v, $unameArr[$k], $user['phone'],$user['email'],$req['status'], $req['unlockday'],$req['remarks']);
                $muc->saveData($v,['status'=>$req['status']]);
            }
        }

        $data = [
                'code'  => 0,
                'msg'   => '封禁成功',
                'userarr' => $uidArr,
            ];
        return \response()->json($data);
    }

}
