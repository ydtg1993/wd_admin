<?php
/**
 * Created by PhpStorm.
 * User: night
 * Date: 2021/6/21
 * Time: 9:45
 */

namespace App\Models;

use App\Services\Logic\RedisCache;
use Illuminate\Database\Eloquent\Model;
class MovieScoreNotes extends Model
{
    protected $table = 'movie_score_notes';

    /**
     * 添加评分
     * @param $data
     */
    public static function add($mid,$uid,$score)
    {
        //删除之前的评分
        MovieScoreNotes::where('mid',$mid)->where('uid',$uid)->update(['status'=>2]);

        //重写一条评分
        $dataObj = new MovieScoreNotes();
        $dataObj->mid = $mid;
        $dataObj->uid = $uid;
        $dataObj->score = $score;
        $dataObj->status = 1;
        $dataObj->save();

        //计算平均分
        $mdb = new MovieScoreNotes();
        $mdb->avg($mid);

        return $dataObj->id;
    }

    /**
     * 计算平均分
     */
    public function avg($mid = 0,$increase = true)
    {
        //读取影片频评分信息
        $movieInfo = Movie::where('id',$mid)->first();
        if(($movieInfo['id']??0)>0)
        {
            $collection_score = $movieInfo->collection_score;
            $collection_score_people = $movieInfo->collection_score_people;
            $score_people = $movieInfo->score_people;
            $people = MovieScoreNotes::where('mid',$mid)->where('source_type',1)->where('status',1)->count();
            $score = MovieScoreNotes::where('mid',$mid)->where('source_type',1)->where('status',1)->sum('score');

            //计算平均分
            if(($collection_score_people + $people) > 0)
            {
                $score = (($collection_score * $collection_score_people) + $score)/($collection_score_people + $people);
            }
            else
            {
                $score = 5;
            }
            if($increase) {
                Movie::where('id', $mid)->update(['score' => $score, 'score_people' => ($score_people + 1)]);
            }else{
                Movie::where('id', $mid)->update(['score' => $score, 'score_people' => ($score_people - 1)]);
            }
        }

        RedisCache::clearCacheManageAllKey('movie');
    }
}
