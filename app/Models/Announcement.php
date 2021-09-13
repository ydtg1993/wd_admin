<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;


class Announcement extends Model
{
    /**
     * @var string
     */
    protected $table = 'system_announcements';
    protected $guarded = ['id'];

    protected $fillable = [
        'uuid',
        'type',
        'title',
        'content',
        'url',
        'remark',
        'display_type',
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
    public static function createTop( $data ){
        $data['uuid'] = \Illuminate\Support\Str::random(32);
        return static::create( $data );
    }

    /**
     * @param $id
     * @param $data
     * @return bool|int
     */
    public static function saveAnnouncement( $id , $data){
        $model = static::where('id',$id)->findOrFail($id);
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
    protected  static $redisPrefix = "announcement:";
    public static $cachePage = 3;
    public static function clearCache( $model ) {
        $redis = Redis::connection();
        for ($i=1;$i<=static::$cachePage;$i++) {
            $cacheKey[] = static::$redisPrefix . 'type:' . $model->type . ":page:".$i;
        }
        $redis->del($cacheKey);
    }


    public static function boot(){
        parent::boot();
        static::created(function ($model){
            static::clearCache($model);
        });
        static::saved(function ($model){
            static::clearCache($model);
        });
        static::deleted(function ($model){
            static::clearCache($model);
        });
    }



}
