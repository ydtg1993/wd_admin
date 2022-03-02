<?php

namespace App\Models;

use App\Tools\RedisCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Tools\UserTool;

class Movie extends Model
{
    protected $table = 'movie';
    private $exp = ['.','-'];

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
     * 添加电影
     *
     */
    public function create($data,$category_id)
    {
        $id = 0;
        //try {
            DB::beginTransaction();
            $id = DB::table('movie')->insertGetId([
                'name' => $data['name'],
                'number'=>$data['number'],
                'release_time' => $data['release_time'],
                'score' => (int)$data['score'],
                'flux_linkage_num' => $data['flux_linkage_num'],
                'flux_linkage' => $data['flux_linkage'],
                'flux_linkage_time'=>date('Y-m-d H:i:s'),//磁链更新时间
                'time'=>$data['time'],
                'sell'=>$data['sell'],
                'is_download' => $data['is_download'],
                'is_subtitle' => $data['is_subtitle'],
                'is_hot' => $data['is_hot'],
                'big_cove' => $data['big_cove'],
                'small_cover' => $data['small_cover'],
                'trailer' => $data['trailer'],
                'cid' => $category_id,
                'map' => $data['map']
            ]);

            /*标签*/
            if($data['arrLabels'])
            {
                $this->dataAssociate('label', $id, $data['arrLabels'], 'cid');
            }

            /*演员*/
            if($data['arrActors'])
            {
                $this->dataAssociate('actor', $id, $data['arrActors'], 'aid');
            }

            /*导演*/
            if($data['director'])
            {
                $this->associate('director', $id, $data['director'], 'did');
            }

            /*系列*/
            if($data['series'])
            {
                $this->associate('series', $id, $data['series'], 'series_id');
            }

            /*片商*/
            if($data['company'])
            {
                $this->associate('film_companies', $id, $data['company'], 'film_companies_id');
            }

            /*分类*/
            if($category_id)
            {
                $this->associate('category', $id, $category_id, 'cid');
            }

            /*番号组*/
            $sGroup = UserTool::getNumberGroup($data['number']);
            if($sGroup)
            {
                //第一个位置位番号组
                $dbNum = MovieNumbers::select('id')->where('name',$sGroup)->first();
                $nId = 0;
                if($dbNum && isset($dbNum->id))
                {
                    $nId = $dbNum->id;
                }else{
                    $nId = MovieNumbers::create($sGroup);
                }
                if($nId)
                {
                    $this->associate('number', $id, $nId, 'nid');
                }
            }

            DB::commit();

            if($id > 0)
            {
                //写入缓存
                $text = base64_encode($data['number']);
                RedisCache::addSet('moive_number',$id,$text);
            }

        /*} catch (\Exception $exception) {
            Log::error('movie error:'.$e->getTraceAsString());
            DB::rollBack();
        }*/
        return $id;
    }

    /**
     * 修改影片
     */
    public function edit($data,$id)
    {
        //try {
            DB::beginTransaction();
            Movie::where('id', $id)->update([
                'name' => $data['name'],
                'number' => $data['number'],
                'number_source' => isset($data['number_source'])?$data['number_source']:'',
                'sell' => $data['sell'],
                'time' => $data['time'],
                'release_time' => $data['release_time'],
                'score' => $data['score'],
                'flux_linkage_num' => $data['flux_linkage_num'],
                'flux_linkage_time' => $data['flux_linkage_time'],
                'flux_linkage' => $data['flux_linkage'],
                'is_download' => $data['is_download'],
                'is_subtitle' => $data['is_subtitle'],
                'is_hot' => $data['is_hot'],
                'cid' => $data['category_id'],
                'status' => 1
            ]);

            /*标签*/
            if(($data['labels']??null) != null)
            {
                $this->dataAssociate('label', $id, explode(',', $data['labels']), 'cid');
            }

            /*演员*/
            if(($data['actors']??null) != null)
            {
                $this->dataAssociate('actor', $id, explode(',', $data['actors']), 'aid');
            }

            /*导演*/
            if($data['director'])
            {
                $this->associate('director', $id, $data['director'], 'did');
            }

            /*系列*/
            if($data['series'])
            {
                $this->associate('series', $id, $data['series'], 'series_id');
            }

            /*片商*/
            if($data['company'])
            {
                $this->associate('film_companies', $id, $data['company'], 'film_companies_id');
            }

            //分类
            if($data['category_id'])
            {
                $this->associate('category', $id, $data['category_id'], 'cid');
            }

            /*番号组*/
            $sGroup = UserTool::getNumberGroup($data['number']);
            if($sGroup)
            {
                $dbNum = MovieNumbers::select('id')->where('name',$sGroup)->first();
                $nId = 0;
                if($dbNum && isset($dbNum->id))
                {
                    $nId = $dbNum->id;
                }else{
                    $nId = MovieNumbers::create($sGroup);
                }

                if($nId)
                {
                    $this->associate('number', $id, $nId, 'nid');
                }
            }

            DB::commit();

        /*} catch (\Exception $exception) {
            Log::error('movie error:'.$e->getTraceAsString());
            DB::rollBack();
        }*/

    }

    /**
     * 删除影片
     */
    public static function rm($ids)
    {
        //删除影片列表
        DB::table('movie')->whereIn('id',$ids)->delete();

        //清除缓存
        foreach($ids as $v)
        {
            RedisCache::delSetWithScore('moive_number',$v);
        }
    }

    /**
     * 上架影片
     */
    public static function up($ids)
    {
        //影片列表
        DB::table('movie')->whereIn('id',$ids)->update(['is_up'=>1]);

        //清除缓存
        foreach($ids as $v)
        {
            RedisCache::delSetWithScore('moive_number',$v);
        }
    }

    /**
     * 下架影片
     */
    public static function down($ids)
    {
        //影片列表
        DB::table('movie')->whereIn('id',$ids)->update(['is_up'=>2]);

        //清除缓存
        foreach($ids as $v)
        {
            RedisCache::delSetWithScore('moive_number',$v);
        }
    }


    /**
     * 获取磁链的数据
     */
    public function getFluxLink($mid = 0)
    {
        $arrMovie = DB::select('select id,flux_linkage_num,flux_linkage from movie where id=? limit 1;',[$mid]);
        return $arrMovie;
    }

    /**
     * 更新磁链数据
     * @param    int     $mid       影片id
     * @param    int     $count     磁链数量
     * @param    string  $fluxLink  磁链数组(json压缩)
     */
    public function updateFluxLink($mid = 0, $count = 0, $fluxLink='')
    {
        DB::table('movie')->where('id', $mid)->update(['flux_linkage_num' => $count,'flux_linkage' => $fluxLink,'flux_linkage_time'=>date('Y-m-d H:i:s',time())]);
    }

    /**
     * 一对一数据表操作
     */
    private function associate($table, $movie_id, $input, $column)
    {
        $movie_director_associate = DB::table('movie_' . $table . '_associate')->where('mid', $movie_id)->first();

        if ($movie_director_associate && $movie_director_associate->{$column} == $input) {
            DB::table('movie_' . $table . '_associate')->where('id',$movie_director_associate->id)->update([$column => $input]);
        } else {
            DB::table('movie_' . $table . '_associate')->insert(['mid' => $movie_id, $column => $input]);
        }

        //更新计数器
        if($table!='category'){
            $res = DB::select("select count(0) as nums from movie_".$table."_associate where ".$column."='".$input."';");
            $nums = $res[0]->nums;
            DB::table('movie_' . $table)->where('id', $input)->update(['movie_sum'=>$nums]);
        }
    }

    /**
     * 一对多，操作数据表
     */
    private function dataAssociate($table, $movie_id, $data, $column)
    {
        $associate_ids = DB::table('movie_' . $table . '_associate')->where('mid', $movie_id)->pluck($column, 'id')->all();
        foreach ($associate_ids as $id => $associate) {
            $index = array_search($associate, $data);
            if ($index !== false) {
                array_splice($data, $index, 1);
                continue;
            }
            DB::table('movie_' . $table . '_associate')->where('id', $id)->delete();
        }
        if (!empty($data)) {
            $insertData = [];
            foreach ($data as $item) {
                $insertData[] = ['mid' => $movie_id, $column => $item];
            }
            DB::table('movie_' . $table . '_associate')->insert($insertData);

             //更新计数器
            if($table !="label"){
                 $res = DB::select("select count(0) as nums from movie_".$table."_associate where ".$column."='".$item."';");
                $nums = $res[0]->nums;
                DB::table('movie_' . $table)->where('id', $item)->update(['movie_sum'=>$nums]);
            }
        }
    }

    /**
     * 格式化影片列表数据
     * @param array $data
     */
    public static function formatList($data = [])
    {
        $is_new_comment_day = ((strtotime($data['new_comment_time'] ?? '') - strtotime(date('Y-m-d 00:00:00'))) >= 0) ? 1 : 2;//最新评论时间减去 今日开始时间 如果大于0 则今日新评论
        $is_new_comment_day = ($is_new_comment_day == 2) ? (
        (((strtotime($data['new_comment_time'] ?? '') - (strtotime(date('Y-m-d 00:00:00')) - (60 * 60 * 24))) >= 0) ? 3 : 2)
        ) : 1;

        $is_flux_linkage_day = ((strtotime($data['flux_linkage_time'] ?? '') - strtotime(date('Y-m-d 00:00:00'))) >= 0) ? 1 : 2;
        $is_flux_linkage_day = ($is_flux_linkage_day == 2) ? (
        (((strtotime($data['flux_linkage_time'] ?? '') - (strtotime(date('Y-m-d 00:00:00')) - (60 * 60 * 24))) >= 0) ? 3 : 2)
        ) : 1;

        $small_cover = $data['small_cover'] ?? '';
        $big_cove = $data['big_cove'] ?? '';
        $reData = [];
        $reData['id'] = $data['id'] ?? 0;

        $reData['name'] = $data['name'] ?? '';
        $reData['number'] = $data['number'] ?? '';
        $reData['release_time'] = $data['release_time'] ?? '';
        $reData['created_at'] = $data['created_at'] ?? '';

        $reData['is_download'] = $data['is_download'] ?? 1;//状态 1.不可下载  2.可下载
        $reData['is_subtitle'] = $data['is_subtitle'] ?? 1;//状态 1.不含字幕  2.含字幕
        $reData['is_hot'] = $data['is_hot'] ?? 1;//状态 1.普通  2.热门
        $reData['is_new_comment'] = $is_new_comment_day;//状态 1.今日新评  2.无状态 3.昨日新评

        $reData['is_flux_linkage'] = $is_flux_linkage_day;//状态 1.今日新种  2.无状态 3.昨日新种
        $reData['comment_num'] = $data['comment_num'] ?? 0;
        $reData['score'] = $data['score'] ?? 0;

        $image_domain = env('IMAGE_DOMAIN', '');
        $reData['small_cover'] = $small_cover == '' ? '' : ($image_domain . $small_cover);

        $reData['big_cove'] = $big_cove == '' ? '' : ($image_domain . $big_cove);
        $reData['is_short_comment'] = $data['is_short_comment'] ?? 0;;

        return $reData;
    }
}
