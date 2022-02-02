<?php

namespace App\Models;

use App\Tools\RedisCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MovieLabelCategory extends Model
{
    protected $table = 'movie_label_category';

    /**
     * 写入一条数据
     * @param   string  $name   名称
     */
    public static function create($name = '',$status = 1)
    {
        //写入数据表
        $da = ['name'=>$name, 'status'=>$status];
        $lid = DB::table('movie_label_category')->insertGetId($da);

        if($lid > 0)
        {
            //写入缓存
            $text = base64_encode(trim($name));
            RedisCache::addSet('movie_label_category',$lid,$text);
        }

        //清除前台的缓存列表
        RedisCache::delKey('label_classes');

        return $lid;
    }

    /**
     * 读取分类列表和包含的父级标签 
    */
    public static function listsWithChildren()
    {
        $res = DB::select("select L.id,L.name,GROUP_CONCAT(A.lid) as children 
            from movie_label_category as L join movie_label_category_associate as A on L.id=A.cid
            where L.status=1 and A.status=1
            group by A.cid;");

        return $res;
    }


}
