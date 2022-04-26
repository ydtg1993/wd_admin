<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\MovieActor;
use App\Models\MovieLog;
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

    protected $this_month;
    protected $last_month;

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
        //$this->movie();
        $this->actor();
    }

    private function movie()
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

    private function actor()
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
            $actor_ids = DB::table('actor_popularity_chart')
                ->where('cid', $type)
                ->where('mtime', '>=', $this->this_month)
                ->orderBy('hot_val', 'desc')
                ->orderBy('up_mhot', 'desc')
                ->offset(0)
                ->limit(100)
                ->pluck('aid')
                ->all();
            $list = MovieActor::whereIn('id', $actor_ids)->get();
            $i = 1;
            $temp = [];
            foreach ($list as $val) {
                $actor = MovieActor::formatList($val);
                $actor['rank'] = $i;
                $i++;
                $temp[] = $actor;
            }
            $reData['sum'] = count($temp);
            $reData['list'] = $temp;
            Redis::setex($cache,3600 * 48, json_encode($reData));
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
                $movies = DB::table('movie_actor_associate')
                    ->join('movie', 'movie_actor_associate.mid', '=', 'movie.id')
                    ->where('movie_actor_associate.aid', $aid)
                    ->where('movie_actor_associate.status', 1)
                    ->where('movie.release_time', '>=', $this->this_month)
                    ->offset(($page - 1) * $pageSize)
                    ->limit($pageSize)
                    ->select('movie.*')
                    ->get();
                $movies = $movies->toArray();
                if (empty($movies)) {
                    //最后结算
                    $newMidCountPv = $newMidCountPv / 500;//浏览数量
                    if ($movie_count > 0) {
                        $wan_see_num = $wan_see_num / $movie_count;
                        $seenNum = $seenNum / $movie_count;
                        $comment_numNum = $comment_numNum / $movie_count;
                    } else {
                        break;
                    }

                    $hotVal = $comment_numNum + $seenNum + $wan_see_num + $newMidCountPv + $movie_count;
                    if (DB::table('actor_popularity_chart')
                        ->where('aid', $aid)
                        ->where('cid', $type)
                        ->where('mtime', $this->this_month)->exists()) {

                        DB::table('actor_popularity_chart')
                            ->where('aid', $aid)
                            ->where('cid', $type)
                            ->where('mtime', $this->this_month)->update(['hot_val' => $hotVal]);
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
                            'up_mhot' => $last_record ? $last_record->hot_val:0
                        ]);
                    }
                    break;
                }
                $page++;
                //累计
                $movie_count += count($movies);
                $newMidCountPv += DB::table('movie_log')
                    ->where('created_at', '>=', $this->this_month)
                    ->whereIn('mid', array_column($movies, 'id'))
                    ->count();
                $wan_see_num += array_sum(array_column($movies, 'wan_see'));
                $seenNum += array_sum(array_column($movies, 'seen'));
                $comment_numNum += array_sum(array_column($movies, 'comment_num'));
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
