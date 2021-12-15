<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Tools\RedisCache;

class MovieNumbers extends Model
{
    protected $table = 'movie_number';

    /**
     * 写入一条数据
     * @param   string  $name   名称
     */
    public static function create($name = '')
    {
        //写入数据表
        $da = ['name'=>$name , 'status'=>1];
        $lid = DB::table('movie_number')->insertGetId($da);

        if($lid > 0)
        {
            //写入缓存
            $text = base64_encode(trim($name));
            RedisCache::addSet('moive_number_group',$lid,$text);
        }

        return $lid;
    }

}
