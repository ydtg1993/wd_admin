<?php

namespace App\Models;

use App\Tools\RedisCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class MovieLabel extends Model
{
    protected $table = 'movie_label';
    private $cacheKey = 'label_lists';

    /**
     * 写入一条数据
     * @param   string  $name   名称
     */
    public static function create($name = '',$sort = 0,$cid = 0)
    {
        //写入数据表
        $da = ['name'=>$name, 'sort'=>$sort, 'cid'=>$cid];
        $lid = DB::table('movie_label')->insertGetId($da);

        if($lid > 0)
        {
            //写入缓存
            $text = base64_encode(trim($name));
            RedisCache::addSet('movie_label',$lid,$text);

            //更新父级数量
            if($cid>0)
            {
                self::countChildren($cid);
            }
        }

         //清除列表缓存
        RedisCache::delKey('label_lists');

        return $lid;
    }

    /**
     * 更新标签数据 
    */
    public static function edit($data,$id)
    {
        //更新
        self::where('id', $id)->update(['name' => $data['name'], 'sort' => $data['sort']]);

        //写入缓存
        $text = base64_encode(trim($data['name']));
        RedisCache::addSet('movie_label',$id,$text);

        //清除列表缓存
        RedisCache::delKey('label_lists');
    }

    //更新子标签所属的父标签
    public static function childrenEditParent($da,$lid)
    {
        //先重置
        self::where('cid',$lid)->update(['cid'=>0]);
        //根据传递的数据，重新分配
        foreach($da as $v)
        {
            self::where('id', $v)->update(['cid' => $lid]);
        }
    }

    //计算父标签下级数量
    public static function countChildren($lid = 0)
    {
        $total = self::where('cid', $lid)->where('status',1)->count();
        $res = self::where('id',$lid)->update(['item_num'=>$total]);
    }

    //不联表的情况下，读取父标签
    public function listForName($name = '',$offset=0,$limit=20)
    {
        $wh = 'cid = 0 and status=1';
        if($name){
            $wh = $wh." and name like '".$name."%' ";
        }
        $res = DB::select("select id,name,item_num,sort,created_at,0 as cids from ".$this->table." where ".$wh." order by sort asc,id desc limit ".$offset.",".$limit.";");
        return $res;
    }

    /**
     * 不联表的情况下，读取父标签
     */
    public function countForName($name='')
    {
        $count = 0;
        $wh = 'cid = 0 and status=1';
        if($name){
            $wh = $wh." and name like '".$name."%' ";
        }
        $res = DB::select("select count(0) as nums from ".$this->table." where ".$wh.";");

        if($res && isset($res[0]))
        {
            $count = $res[0]->nums;
        }
        return $count;
    } 

    /**
     * 根据分类id读取父级标签列表和所属分类id 
    */
    public function listForCid($name= '',$cid=0,$offset=0,$limit=20)
    {
        $wh = 'L.cid = 0 and L.status=1 and A.status=1';
        if($name){
            $wh = $wh." and L.name like '".$name."%' ";
        }
        if($cid>0){
            $wh = $wh." and A.cid = ".$cid;
        }
        $res = DB::select("select L.id,L.name,L.item_num,L.sort,L.created_at,GROUP_CONCAT(A.cid) as cids from ".$this->table." as L join movie_label_category_associate as A on L.id=A.lid where ".$wh." group by A.lid order by L.sort asc,L.id desc limit ".$offset.",".$limit.";");

        return $res;
    }

    /**
     * 根据分类id读取顶级数量
     */
    public function countForCid($name='',$cid=0)
    {
        $count = 0;
        $wh = 'L.cid = 0 and L.status=1';
        if($name){
            $wh = $wh." and L.name like '".$name."%' ";
        }
        if($cid>0){
            $wh = $wh." and A.cid = ".$cid;
        }
        $res = DB::select("select count(distinct A.lid) as nums from ".$this->table." L join movie_label_category_associate A on L.id=A.lid where ".$wh.";");

        if($res && isset($res[0]))
        {
            $count = $res[0]->nums;
        }
        return $count;
    }

    /**
     * 通过影片id，来读取列表 
     */
    public static function getForMid($mid = 0)
    {
        $res = DB::select("select D.name from movie_label as D left join movie_label_associate as A on D.id=A.cid where A.mid=$mid and A.status=1 and D.status=1 limit 100;");

        return $res;
    }

    /**
     * 读取父级列表和包含的子级标签 
    */
    public static function listsWithChildren()
    {
        $res = DB::select("select L.id,L.name,GROUP_CONCAT(A.id) as children 
            from movie_label as L join movie_label as A on L.id=A.cid
            where L.cid=0 and L.status=1 and A.cid>0 and A.status=1
            group by A.cid;");

        return $res;
    }
}
