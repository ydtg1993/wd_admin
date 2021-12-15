<?php

namespace App\Models;
use App\Tools\RedisCache;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{

    protected $guarded = ['id'];
    protected $table = 'filter_keyword';
    protected $cacheKey = 'filter_keyword';

    public function add($da)
    {
        //清除缓存
        RedisCache::delKey($this->cacheKey);

        return DB::table($this->table)->insertGetId(['content'=>$da['content'],'adminer'=>$da['adminer']]);
    }

    public function rm($id)
    {
        //清除缓存
        RedisCache::delKey($this->cacheKey);

        return DB::delete('delete from filter_keyword where id='.$id.';');
    }

    public function edit($id,$content,$adminer)
    {
        //清除缓存
        RedisCache::delKey($this->cacheKey);

        return Filter::where('id',$id)->update(['content'=>$content,'adminer'=>$adminer]);
    }

    /**
     * 判断是否存在
     */
    public static function check($text='')
    {
        $casheKey = 'filter_keyword';
        //优先读取缓存
        $res = RedisCache::getSetAll($casheKey);

        if(count($res)<1)
        {
            //从数据库读取
            $mRes = DB::select('select id,content from filter_keyword order by id asc limit 200');

            //写入缓存
            foreach ($mRes as $val) {
                RedisCache::addSets($casheKey, $val->content);
                $res[]=$val->content;
            }
        }

        foreach($res as $v)
        {
            if(strpos($text,$v) !== false)
            {
                return true;
            }
        }

        return false;
    }

}
