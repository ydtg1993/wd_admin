<?php
namespace App\Providers\Es\Model;


use App\Providers\Es\Service\RedisTrait;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{


    use ElasticquentTrait;

    use RedisTrait;

    //override
    protected $cacheField = 'video';

    public  function getLastIncrementId(){
        return $this->redisConnection()->setRedisField($this->cacheField)->getRedisLastIncrement();
    }

    public  function setRedisIncrementId( $autoIncrementId ){
        return $this->redisConnection()->setRedisField($this->cacheField)->setRedisIncrement($autoIncrementId);
    }
    //override
    public static function bulkToIndex( $where=[] ){}
    //override
    public function getLastIdFromDB(){}
}
