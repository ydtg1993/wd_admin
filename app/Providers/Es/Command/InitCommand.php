<?php
namespace App\Providers\Es\Command;

use App\Models\ViedoElasticquent;
use App\Providers\Es\Model\VideoModel ;
use App\Providers\Es\Service\VideoEsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

/**
 * @Description 存在两个超时问题 1.cli 超时 2.mysql超时【已使用分批】
 * Class InitCommand
 * @package App\Providers\Es\Command
 */
class InitCommand extends BaseCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Es:Init {modelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init Es Index {model name in EsServiceProvider}';

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
    public function handleLogic()
    {
        try {
            $modelName = $this->argument('modelName');
            $dbLastId = App::make($modelName)->getLastIdFromDB();
            if($dbLastId <=0 ){
                Log::info( "db 没有数据");
            }
            //create index
            App::make($modelName)::createIndex();
            //mapping
            App::make($modelName)::putMapping($ignoreConflicts = true);
            //push data to es
            App::make($modelName)::bulkToIndex();
            App::make($modelName)->setRedisIncrementId($dbLastId);
            $this->info("成功完毕");
            return true;
        }catch (\Exception | \Throwable $e){
            $this->error("请查看日志 有错误信息");
            Log::error('error:'.$e->getTraceAsString());
        }
    }


}
