<?php
namespace App\Providers\Es\Command;

use App\Models\ViedoElasticquent;
use App\Providers\Es\Model\VideoModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class  IncrementCommand extends BaseCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Es:Increment {modelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment Es Index {model name in EsServiceProvider}';

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
            //参数
            $modelName = $this->argument('modelName');
            $dbLastId = App::make($modelName)->getLastIdFromDB();
            if($dbLastId <=0 ){
                Log::info( "db 没有数据");
                return true;
            }
            $incrementId = App::make($modelName)->getLastIncrementId();
            if ($incrementId <= 0) {
                Log::info( ":数据未初始化 请先执行init");
                return true;
            }
            if($dbLastId == $incrementId){
                Log::info( "数据已最新");
                return true;
            }
            //push data to es
            $where = ['id'=>$incrementId];
            App::make($modelName)::bulkToIndex($where);
            App::make($modelName)->setRedisIncrementId($dbLastId);
            $this->info("成功完毕");
            return true;
        }catch (\Exception | \Throwable $e){
            $this->error("请查看日志 有错误信息");
            Log::error('error:'.$e->getTraceAsString());
        }
    }


}
