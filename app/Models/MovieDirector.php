<?php

namespace App\Models;

use App\Tools\RedisCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MovieDirector extends Model
{
    protected $table = 'movie_director';

    /**
     * 写入一条数据
     * @param   string  $name   名称
     */
    public static function create($name = '',$status = 1)
    {
        //写入数据表
        $da = ['name'=>$name , 'status'=>$status];
        $lid = DB::table('movie_director')->insertGetId($da);

        if($lid > 0)
        {
            //写入缓存
            $text = base64_encode(trim($name));
            RedisCache::addSet('movie_director',$lid,$text);
        }

        return $lid;
    }

    /**
     * 通过影片id，来读取名称
     */
    public static function getForMid($mid = 0)
    {
        $res = '';
        $row = DB::select("select D.id,D.name,A.mid from movie_director as D left join movie_director_associate as A on D.id=A.did where A.mid=$mid and A.status=1 and D.status=1 limit 1;");

        if(isset($row) && isset($row[0]))
        {
            $res = $row[0]->name;
        }
        return $res;
    }
}
