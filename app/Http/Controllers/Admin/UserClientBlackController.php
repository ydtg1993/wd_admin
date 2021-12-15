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

class UserClientBlackController extends Controller
{
    /**
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.user_client.black');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $data = $request->all(['created_at_start','created_at_end','uid','uname','phone','email']);

        $res = UserClientBlack::when($data['uid'],function ($query,$data) {
                //查询用户id
                return $query->where('uid',$data);
            })->when($data['uname'],function ($query,$data) {
                //查询用户昵称/用户名
                return $query->where('uname','like',$data.'%');
            })->when($data['phone'],function ($query,$data) {
                //查询用户号码
                return $query->where('phone',$data);
            })->when($data['email'],function ($query,$data) {
                //查询用户邮箱
                return $query->where('email',$data);
            })->when($data['created_at_start'],function ($query,$data){
                return $query->where('created_at','>=',$data);
            })->when($data['created_at_end'],function ($query,$data){
                return $query->where('created_at','<=',$data);
            })->select('id','uid','uname','phone',
                'email','status','unlock_time','remarks','created_at')
            ->where('status','>',1)
            ->orderBy('id','desc')->paginate($request->get('limit',30));
        $statusMap = [
            2=>'禁言',
            3=>'拉黑',
        ];

        if (count($res->items()) >0 ){
            foreach ($res->items() as $k=>$v){
                $res->items()[$k]->status = $statusMap[$res->items()[$k]->status];
                $unlockTime = strtotime($res->items()[$k]->unlock_time);

                //解封时间超过1年的，就是永久封禁
                if(($unlockTime - time())/86400 >365){
                    $res->items()[$k]->unlock_time = '永久';
                }
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
     * 解封用户
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unlockUser(Request $request ): \Illuminate\Http\JsonResponse
    {

        $uid = $request->input('uid');

        $mb = new UserClientBlack();
        //判断是否已经有
        $mb->unlock($uid);

        //修改用户表状态
        UserClient::updateStatus($uid,1);

        $data = [
                'code'  => 0,
                'msg'   => '解封成功',
            ];
        return \response()->json($data);
    }
}
