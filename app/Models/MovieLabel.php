<?php

namespace App\Models;

use App\Tools\RedisCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MovieLabel extends Model
{
    protected $table = 'movie_label';

    /**
     * 写入一条数据
     * @param   string  $name   名称
     */
    public static function create($name = '',$status = 1,$cid = 0)
    {
        //写入数据表
        $da = ['name'=>$name, 'status'=>$status, 'cid'=>$cid];
        $lid = DB::table('movie_label')->insertGetId($da);

        if($lid > 0)
        {
            //写入缓存
            $text = base64_encode(trim($name));
            RedisCache::addSet('movie_label',$lid,$text);
        }

        return $lid;
    }
}
