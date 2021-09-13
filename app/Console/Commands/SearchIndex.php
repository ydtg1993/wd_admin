<?php

namespace App\Console\Commands;

use App\Models\ViedoElasticquent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class SearchIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'searchIndex {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'manage the search index';

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

        //开始
        $this->line("-----------------------------------------------------------------");
        $this->line("搜索索引操作：开始");
        $this->info_log('search index flush begin');

        //参数
        $action = $this->argument('action') ?? null;
        if (empty($action)) {
            $this->error_log("参数为空");
            exit();
        }

        //操作
        if($action =='init'){
            $this->info_log("创建索引");

            $result = ViedoElasticquent::createIndex();

            var_dump($result);
            $result = ViedoElasticquent::putMapping($ignoreConflicts = true);
            //$result = VideoElasticquent::addAllToIndex();
            var_dump($result);
            $result = ViedoElasticquent::with('actors')->with('directors')->chunk(200, function($video) {

                $video->addToIndex();
            });
            var_dump($result);

        }else if($action == 'del'){
            $this->info_log("删除索引");
            $result = ViedoElasticquent::deleteIndex();
            var_dump($result);

        }else if($action == 'flush'){

            $this->info_log("刷新索引");
            //$result = VideoElasticquent::reindex();
            $result = ViedoElasticquent::deleteIndex();
            var_dump($result);

            $result = ViedoElasticquent::createIndex();
            var_dump($result);
            $result = ViedoElasticquent::putMapping($ignoreConflicts = true);
            var_dump($result);
            $result = ViedoElasticquent::with('actors')->with('directors')->chunk(200, function($video) {
                $video->addToIndex();
            });
            var_dump($result);

        }else{
            $this->error_log("参数没有对应操作");
            exit();
        }

        //结束
        $this->line("搜索索引操作：结束");
        $this->info_log('search index flush end');
        $this->line("-----------------------------------------------------------------");

    }

    public function info_log($msg = '',$data = []){
        $this->info($msg);
        Log::info($msg,$data);
        return true;
    }


}
