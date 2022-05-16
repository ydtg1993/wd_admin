<?php

namespace App\Models;

use App\Services\Logic\Common;
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
     * 格式化演员列表数据
     * @param array $data
     */
    public static function formatList($data = [])
    {
        $photo = $data['photo']??'';
        $reData = [];
        $reData['id'] = $data['id']??0;
        $reData['name'] = $data['name']??'';
        $image_domain = config('app.url').'resources/';
        $reData['photo'] = $photo == ''?'':($image_domain.$photo);
        $reData['sex'] = $data['sex']??1;
        $reData['social_accounts'] = json_decode($data['social_accounts']??'',true) ;
        $reData['movie_sum'] = $data['movie_sum']??0;
        $reData['like_sum'] = $data['like_sum']??0;
        $reData['info'] = [
            'new_movie_count' =>$data['new_movie_count'],
            'new_movie_pv' =>$data['new_movie_pv'],
            'new_movie_want' =>$data['new_movie_want'],
            'new_movie_seen' =>$data['new_movie_seen'],
            'new_movie_score' =>$data['new_movie_score'],
            'new_movie_score_people' =>$data['new_movie_score_people'],
        ];
        return $reData;
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
