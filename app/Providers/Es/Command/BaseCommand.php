<?php
namespace App\Providers\Es\Command;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use ReflectionClass;
class BaseCommand extends command{
    public function __construct()
    {
        parent::__construct();
    }
    protected function init(){
        set_time_limit(20*60);
        Log::setDefaultDriver('Es');
        Log::info('----start'.(new ReflectionClass($this))->getShortName().
            ' modelName='.$this->argument('modelName').'----');
    }
    public function handle()
    {
        $this->init();
        $this->handleLogic();
        $this->end();
    }
    protected function end(){
        Log::info('----end'.(new ReflectionClass($this))->getShortName().
            ' modelName='.$this->argument('modelName').'----');
    }
}
