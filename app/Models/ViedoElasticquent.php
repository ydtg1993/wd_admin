<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class ViedoElasticquent extends Model
{
    //

	use ElasticquentTrait;

 	protected $table = 'movie';

    protected $guarded = ['id'];

    /**
     * @Description 关联演员影片表
     * @DateTime    2018-10-31
     * @copyright   [copyright]
     * @return      [type]      [description]
     */
    public function actors()
    {
        return $this->belongsToMany('App\Models\MovieActor', 'movie_actor_associate', 'mid', 'aid');
    }


    /**
     * @Description 关联演员影片表
     * @DateTime    2018-10-31
     * @copyright   [copyright]
     * @return      [type]      [description]
     */
    public function directors()
    {
        return $this->belongsToMany('App\Models\MovieDirector', 'movie_director_associate', 'mid', 'did');
    }

    /**
     * The elasticsearch settings.
     *
     * @var array
     */
    protected $indexSettings = [
        'analysis' => [
            'char_filter' => [],
            'filter' => [],
            "tokenizer"=> [
                "tokenizer_number"=> [
                    "type"=> "classic",
                ],
            ],
            'analyzer' => [
                'analyzer_number' => [
                    'type' => 'custom',
                    'tokenizer' => 'tokenizer_number',
                    'filter' => [
                        'classic',
                        'lowercase'
                    ],
                ],
                "comma"=> [
                    "type"=> "pattern",
                    "pattern"=>",",
                ],
            ],
        ],
    ];

    //对应es的mapping
    protected $mappingProperties = [
        'id' => [
            'type' => 'integer',
        ],

        'name' => [
            'type' => 'text',
            'analyzer' => 'ik_smart',
            'search_analyzer' => 'ik_smart',
        ],//ik_max_word

        //车牌号不用中文分词
        'number' => [
            'type' => 'text',
            'analyzer' => 'standard',
            'search_analyzer' => 'standard',
        ],

        'actors.name'=>[
            'type' => 'text',
            'analyzer' => 'ik_smart',
            'search_analyzer' => 'ik_smart',
        ],

        'status' => [
            'type' => 'byte',
        ],

        //不搜索字段
        'big_cove'=>[
            'type' => 'text',
            'index'=> false
        ],

        'small_cover'=>[
            'type' => 'text',
            'index'=> false
        ],

        'created_at'=>[
            'type' => 'text',
            'index'=> false
        ],

        'updated_at'=>[
            'type' => 'text',
            'index'=> false
        ],

        'release_time'=>[
            'type' => 'text',
            'index'=> false
        ],

        'actors.created_at'=>[
            'type' => 'text',
            'index'=> false
        ],

        'actors.id'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'actors.like_sum'=>[
            'type' => 'text',
            'index'=> false
        ],

        'actors.movie_sum'=>[
            'type' => 'text',
            'index'=> false
        ],

        'actors.oid'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'actors.photo'=>[
            'type' => 'text',
            'index'=> false
        ],

        'actors.pivot.aid'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'actors.sex'=>[
            'type' => 'text',
            'index'=> false
        ],

        'actors.pivot.mid'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'actors.social_accounts'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'actors.status'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'actors.updated_at'=>[
            'type' => 'text',
            'index'=> false
        ],

        'collection_comment_num'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'collection_score'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'collection_score_people'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'comment_num'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'directors.created_at'=>[
            'type' => 'text',
            'index'=> false
        ],

        'directors.id'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'directors.like_sum'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'directors.movie_sum'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'directors.name'=>[
            'type' => 'text',
            'index'=> false
        ],

        'directors.oid'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'directors.pivot.did'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'directors.pivot.mid'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'directors.status'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'directors.updated_at'=>[
            'type' => 'text',
            'index'=> false
        ],

        'flux_linkage'=>[
            'type' => 'text',
            'index'=> false
        ],

        'flux_linkage_num'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'flux_linkage_time'=>[
            'type' => 'text',
            'index'=> false
        ],

        'is_download'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'is_hot'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'is_short_comment'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'is_subtitle'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'is_up'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'issued'=>[
            'type' => 'text',
            'index'=> false
        ],

        'map'=>[
            'type' => 'text',
            'index'=> false
        ],

        'new_comment_time'=>[
            'type' => 'text',
            'index'=> false
        ],

        'oid'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'score'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'score_people'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'seen'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'sell'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'time'=>[
            'type' => 'integer',
            'index'=> false
        ],

        'trailer'=>[
            'type' => 'text',
            'index'=> false
        ],

        'wan_see'=>[
            'type' => 'integer',
            'index'=> false
        ],

    ];

    function getIndexName(){
        return 'video';
    }


}
