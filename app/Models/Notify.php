<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notify extends Model
{
    protected $table = 'notify';

    /**
     * 发系统消息 
     * @param   int     @ty         类型
     * @param   int     @adminId    管理员id
     * @param   string  @admin      管理员名称
     * @param   int     @uid        收消息的用户id
     * @param   string  @content    消息内容
     */
    public function sysNotify($ty=9, $adminId=-9, $admin='admin',$uid=0, $content='')
    {
        $id = DB::table($this->table)->insertGetId([
                    'content' => $content,
                    'type' => $ty,
                    'sender_id' => $adminId,
                    'sender_name' => $admin,
                    'uid' => $uid
                ]);
        return $id;
    }
}
