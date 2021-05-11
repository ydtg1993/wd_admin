<?php

namespace App\Console\Commands;

use App\Services\Logic\SqlUpdate\Sql;
use App\Services\Logic\SqlUpdate\SqlUpdateLogic;
use Illuminate\Console\Command;

class DBInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DBInit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化数据库内容';

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
        //
        echo '初始化数据库！'.PHP_EOL;
        SqlUpdateLogic::initTable();
        echo '初始化数据库完成！'.PHP_EOL;

        echo '初始化数据库变更！'.PHP_EOL;
        SqlUpdateLogic::upDateTable();
        echo '初始化数据库变更完成！'.PHP_EOL;
    }
}
