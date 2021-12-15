<?php
namespace App\Models;

use App\Tools\RedisCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class Domain extends Model
{
    protected $table = 'sys_domain';
    protected $cacheKey = 'sys_domain';

    /**
     * 写入数据
     */
    public function add($da=array())
    {
        //重写入
        foreach($da as $v)
        {
            if($v){
                $chk = DB::select('select id from '.$this->table.' where domain=? limit 1;',[$v]);
                if(!$chk){
                    DB::table($this->table)->insertGetId(['domain' => $v]);
                }
            }
        }

        //清除缓存
        RedisCache::delKey($this->cacheKey);
    }

    /**
     * 删除
     */
    public function del($id)
    {
        //清除数据
        DB::delete('delete from '.$this->table.' where id=? limit 1;',[$id]);

        //清除缓存
        RedisCache::delKey($this->cacheKey);
    }

}
