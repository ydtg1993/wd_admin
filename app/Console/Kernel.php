<?php

namespace App\Console;

use App\Providers\Es\Command\FlushCommand;
use App\Providers\Es\Command\IncrementCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\SearchIndex::class,
        \App\Providers\Es\Command\InitCommand::class,
        \App\Providers\Es\Command\FlushCommand::class,
        \App\Providers\Es\Command\IncrementCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {

        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
