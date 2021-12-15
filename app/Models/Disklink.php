<?php

namespace App\Models;

use App\Tools\RedisCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Disklink extends Model
{
    protected $table = 'disklink';

    /**
 * 计算总数 
 */
    public function total($where=array())
    {
        $wh = 'status>0 ';

        if($where){
            foreach($where as $k=>$v){
                $wh = $k."= '".$v."' and ".$wh;
            }
        }

        $aTotal = DB::select('select count(0) as nums from '.$this->table.' where '.$wh);
        return $aTotal[0]->nums;
    }

/**
 * 读取列表
 */
    public function lists($where=array(),$fields='id,displayname', $limit=10, $offset=0)
    {
        $wh = ' status>0 ';
        if($where){
            foreach($where as $k=>$v){
                $wh = $k."= '".$v."' and ".$wh;
            }
        }

        $res =DB::select('select '.$fields.' from '.$this->table.' where '.$wh.' order by id desc limit '.$offset.','.$limit.';');
        return $res;
    }

}
