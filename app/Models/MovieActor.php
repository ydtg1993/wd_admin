<?php

namespace App\Models;

use App\Tools\RedisCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MovieActor extends Model
{
    protected $table = 'movie_actor';

    /**
     * 写入一条数据
     * @param   string  $name   名称
     */
    public static function create($name = '',$status = 1,$sex = 1,$photo = '',$sa = '')
    {
        //写入数据表
        $da = [
            'name'=>$name, 
            'status'=>$status, 
            'sex'=>$sex,
            'photo'=>$photo,
            'social_accounts'=>$sa
        ];
        $lid = DB::table('movie_actor')->insertGetId($da);

        if($lid > 0)
        {
            //写入缓存
            $text = base64_encode(trim($name));
            RedisCache::addSet('movie_actor',$lid,$text);
        }

        return $lid;
    }

    /**
     * 通过影片id，来读取列表 
     */
    public static function getForMid($mid = 0)
    {
        $res = DB::select("select D.name,A.sex from movie_actor as D left join movie_actor_associate as A on D.id=A.aid where A.mid=$mid and A.status=1 and D.status=1 limit 100;");

        return $res;
    }
}
