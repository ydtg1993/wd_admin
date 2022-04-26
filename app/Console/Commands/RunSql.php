<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\MovieCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RunSql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RunSql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
       $this->changeMovieCategory();

    }

    private function changeMovieCategory()
    {
        ini_set('memory_limit', '256M');
        MovieCategory::where('id',14)->delete();
        $page = 1;
        $limit = 1000;
        $logs = storage_path('/changeMovieCategory');
        if(!is_dir($logs)){
            mkdir($logs);
        }
        while (true){
            $start = ($page - 1) * $limit;
            $data = Movie::where('cid',14)->take($limit)
                ->skip($start)
                ->get();
            $data = $data->toArray();
            $page++;
            if (empty($data)) {
                break;
            }
            try {
                DB::beginTransaction();
                $ids = array_column($data, 'id');
                Movie::whereIn('id',$ids)->update(['cid'=>10]);
            } catch (\Exception $e) {
                DB::rollBack();
                continue;
            }
            file_put_contents($logs.'/'.$page,json_encode($ids));
            DB::commit();
        }
    }
}
