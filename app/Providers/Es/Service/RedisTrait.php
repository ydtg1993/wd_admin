<?php
namespace App\Providers\Es\Service;


use Illuminate\Support\Facades\Redis;

Trait RedisTrait{
    protected $redis;
    protected $cacheKey='Es:IncrementFlag';
    protected $field;

    public  function getRedisLastIncrement(){
        return $this->redis->hget($this->cacheKey,$this->field);
    }

    public  function setRedisIncrement( $incrementId ){
        $this->redis->hset($this->cacheKey,$this->field,$incrementId);
    }

    public  function redisConnection()
    {
        $this->redis =  Redis::connection();
        return $this;
    }


    public function setRedisField( $field )
    {
        $this->field = $field;
        return $this;
    }
}
