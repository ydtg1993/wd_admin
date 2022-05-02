<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\MovieComment;
use App\Models\MovieLog;
use App\Models\UserSeenMovie;
use App\Models\UserWantSeeMovie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class RankList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '排行榜缓存';

    /*演员统计 参数*/
    protected $this_month;
    protected $last_month;
    protected $total;//每种类型统计上限100条

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '256M');
        $this->movie();
        $this->actor();
    }

    public function movie()
    {
        $this->clearAll('Rank:movie:rank:*');
        $types = [1, 2, 3, 4, 10];
        $times = [0, 1, 2, 3];
        foreach ($types as $type) {
            foreach ($times as $time) {
                $cache = "Rank:movie:rank:{$type}:{$time}";
                $records = MovieLog::getRankingVersion($type, $time);
                Redis::setex($cache, 3600 * 48, json_encode($records));
            }
        }
    }

    public function actor()
    {
        $this->clearAll('Rank:actor:rank:*');
        $this->actorHotProcess();
    }

    /**
     * 演员热度统计
     */
    private function actorHotProcess()
    {
        $types = DB::table('movie_actor_category')->pluck('id')->all();
        $this->this_month = date('Y-m-01 00:00:00', time());//本月时间
        $this->last_month = date('Y-m-01 00:00:00', strtotime('-1 month'));
        $page = 1;
        $pageSize = 500;//一次处理500条

        foreach ($types as $type) {
            $this->total = 100;//每种类型统计上限100条 重置
            while (true) {
                //该类型所有演员 分片处理
                $aids = DB::table('movie_actor_category_associate')
                    ->where('cid', $type)
                    ->where('status', 1)
                    ->offset(($page - 1) * $pageSize)
                    ->limit($pageSize)->pluck('aid')->all();
                if (empty($aids)) {
                    break;
                }
                $page++;
                //演员热度 分片计算
                $this->actorHotCal($type, $aids);
            }

            //计入缓存
            $cache = "Rank:actor:rank:{$type}";
            $reData = ['list' => [], 'sum' => 0];
            $actors = DB::table('actor_popularity_chart')
                ->join('movie_actor', 'actor_popularity_chart.aid', '=', 'movie_actor.id')
                ->where('actor_popularity_chart.cid', $type)
                ->where('actor_popularity_chart.mtime', $this->this_month)
                ->orderBy('actor_popularity_chart.hot_val', 'desc')
                ->orderBy('actor_popularity_chart.up_mhot', 'desc')
                ->offset(0)
                ->limit(100)
                ->select('movie_actor.*')
                ->get()->toArray();
            if (empty($actors)) {
                continue;
            }
            $total = count($actors);
            if($total<100){
                $rest = 100 - $total;
                $records = DB::table('actor_popularity_chart')
                    ->join('movie_actor', 'actor_popularity_chart.aid', '=', 'movie_actor.id')
                    ->where('actor_popularity_chart.cid', $type)
                    ->whereNotIn('actor_popularity_chart.aid', array_column($actors,'id'))
                    ->where('actor_popularity_chart.mtime','<', $this->this_month)
                    ->orderBy('actor_popularity_chart.hot_val', 'desc')
                    ->orderBy('actor_popularity_chart.up_mhot', 'desc')
                    ->offset(0)
                    ->limit($rest)
                    ->select('movie_actor.*')
                    ->get()->toArray();

                $actors = array_merge($actors ,$records);
            }
            $i = 1;
            $temp = [];
            foreach ($actors as $val) {
                $actor = MovieActor::formatList((array)$val);
                $actor['rank'] = $i;
                $i++;
                $temp[] = $actor;
            }
            $reData['sum'] = count($temp);
            $reData['list'] = $temp;
            Redis::setex($cache, 3600 * 48, json_encode($reData));
        }
    }

    private function actorHotCal($type, $aids)
    {
        foreach ($aids as $aid) {
            $movie_count = 0;//新增影片数量
            $newMidCountPv = 0;//浏览数量
            $wan_see_num = 0;//想看数量
            $seenNum = 0;//看过数量
            $comment_numNum = 0;//评论数量

            $page = 1;
            $pageSize = 500;//一次处理500条
            while (true) {
                //该用户本月新增影片
                $movie_ids = DB::table('movie_actor_associate')
                    ->join('movie', 'movie_actor_associate.mid', '=', 'movie.id')
                    ->where('movie_actor_associate.aid', $aid)
                    ->where('movie_actor_associate.status', 1)
                    ->whereBetween('movie.release_time', [$this->last_month, $this->this_month])
                    ->offset(($page - 1) * $pageSize)
                    ->limit($pageSize)
                    ->pluck('movie.id')
                    ->all();
                if (empty($movie_ids)) {
                    //最后结算
                    if ($movie_count == 0) {
                        break;
                    }
                    //计算热度
                    $hotVal = ($comment_numNum + $seenNum + $wan_see_num)/$movie_count + $newMidCountPv/500 + $movie_count;
                    if ($hotVal == 0) {
                        break;
                    }

                    $actor_popularity_chart = DB::table('actor_popularity_chart')
                        ->where('aid', $aid)
                        ->where('cid', $type)
                        ->where('mtime', $this->this_month)->first();
                    if ($actor_popularity_chart) {
                        DB::table('actor_popularity_chart')
                            ->where('id', $actor_popularity_chart->id)
                            ->update(['hot_val' => $hotVal]);
                    } else {
                        $last_record = DB::table('actor_popularity_chart')
                            ->where('aid', $aid)
                            ->where('cid', $type)
                            ->where('mtime', $this->last_month)
                            ->first();

                        DB::table('actor_popularity_chart')->insert([
                            'aid' => $aid,
                            'cid' => $type,
                            'mtime' => $this->this_month,
                            'hot_val' => $hotVal,
                            'up_mhot' => $last_record ? $last_record->hot_val : 0
                        ]);
                    }
                    break;
                }
                $page++;
                //累计
                $movie_count += count($movie_ids);
                $newMidCountPv += DB::table('movie_log')
                    ->where('created_at', '>=', $this->this_month)
                    ->whereIn('mid', $movie_ids)
                    ->count();
                $wan_see_num += UserWantSeeMovie::where('status', 1)->whereIn('mid', $movie_ids)->count();
                $seenNum += UserSeenMovie::where('status', 1)->whereIn('mid', $movie_ids)->count();
                $comment_numNum += MovieComment::where(['status' => 1, 'cid' => 0])->whereIn('mid', $movie_ids)->count();
            }
        }
    }

    private function clearAll($cache)
    {
        $prefix = config('database.redis.options.prefix');
        $keys = Redis::keys($cache);
        foreach ($keys as $key) {
            Redis::del(str_replace($prefix, '', $key));
        }
    }
}
