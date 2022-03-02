<?php

namespace App\Console\Commands;

use App\Models\Movie;
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
        $this->clearAll('Rank:movie:rank:*');
        $this->movie();
    }

    private function movie()
    {
        $types = [1,2,3,4,10];
        $times = [0,1,2,3];
        foreach ($types as $type){
            foreach ($times as $time){
                $cache = "Rank:movie:rank:{$type}:{$time}";
                $records = MovieLog::getRankingVersion($type,$time);
                Redis::setex($cache, 3600*48, json_encode($records));
            }
        }
    }

    private function actor()
    {

    }

    private  function clearAll($cache){
        $prefix = config('database.redis.options.prefix');
        $keys = Redis::keys($cache);
        foreach ($keys as $key){
            Redis::del(str_replace($prefix,'',$key));
        }
    }
}
