<?php

namespace App\Models;



use App\Tools\RedisCache;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
class UserClient extends Model
{
    protected $table = 'user_client';
    protected $guarded = ['id'];

    protected $fillable = [

        'number',
        'status',
        'phone',
        'email',
        'nickname',
        'pwd',
        'sex',
        'type',
        'age',
        'attention',
        'fans',
        'avatar',
        'intro',
        'le_phone_time',
        'le_phone_status',
        'le_email_time',
        'le_email_status',
        'login_time',
        'login_ip',
        'created_at',
        'updated_at',

    ];

    /**
     * @param $id
     * @return array
     */
    public static  function getOneById( $id ){
        return static::where('id','=',$id)->first()??[];
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function createData( $data ){
        $data['uuid'] = Str::random(32);
        $data['number'] = Str::random(32);
        return static::create( $data );
    }

    /**
     * @param $id
     * @param $data
     * @return bool|int
     */
    public function saveData($id , $data){
        $model = UserClient::where('id',$id)->findOrFail($id);
        return $model->update($data);
    }

    /***
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     * @throws \Exception
     */
    public static function deleteById( $id ){
        try {
            $model = static::where('id',$id)->findOrFail($id);
            $model->destroy($id);
            return  $model;
        }catch (\Exception $e){
            throw new \Exception($e);
        }
    }
    /**
     * 邮箱重复检查
     * @param $email
     * @return bool 存在true 不存在 false
     */
    public static function checkEmail($email)
    {
        $userInfo = UserClient::where('email',$email)->first();
        if(!$userInfo)
        {
            return false;
        }

        $userInfo = $userInfo->toArray();
        if(($userInfo['id']??0) > 0 )
        {
            return true;
        }

        return false;
    }

    /**
     * 邮箱重复检查
     * @param $email
     * @return bool 存在true 不存在 false
     */
    public static function checkEmailNotMe($email ,$id)
    {
        $userInfo = UserClient::where('email',$email)->first();
        if(!$userInfo)
        {
            return false;
        }

        $userInfo = $userInfo->toArray();
        if(($userInfo['id']??0) > 0 )
        {
            return $userInfo['id']!=$id;
        }

        return false;
    }

    public static function boot(){
        parent::boot();
        static::saved(function ($model){
            static::clearCache($model);
        });
        static::deleted(function ($model){
            static::clearCache($model);
        });
    }
    public static function clearCache( $model )
    {
        $cacheConf = RedisCache::getCacheConfig();
        $redisKey = RedisCache::getKey('userinfo:first:',['id'=>$model->id,]);
        Redis::del($redisKey);
    }

}
