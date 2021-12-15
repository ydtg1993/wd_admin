<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\MovieCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MergeCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:MergeCategory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '合并分类关系表的数据到影片列表分类字段';

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
        $this->merge();
        echo '数据处理完成'.PHP_EOL;
    }
    

    private function merge()
    {
        $res = DB::select('SELECT id FROM movie where cid<1 order by id asc limit 20');

        //获取不到这个值后，跳出循环
        if(!$res){
            return 0;
        }
        
        //循环写入数据
        foreach($res as $val)
        {
            $id = $val->id;
            $cid = $this->getCid($id);
            DB::table('movie')->where('id',$id)->update(['cid'=>$cid]);
            echo '更新影片id:'.$id.', cid='.$cid.PHP_EOL;
        }

        //递归自身
        $this->merge();
    }

    //如果没有数据，这里默认到分类1
    private function getCid($mid)
    {
        $cid = 1;
        $res = DB::select('SELECT cid FROM movie_category_associate where mid='.$mid.' limit 1;');

        if(count($res)>0 && isset($res[0]) && $res[0]->cid>0){
            $cid = $res[0]->cid;
        }
        return $cid;
    }
        
}

