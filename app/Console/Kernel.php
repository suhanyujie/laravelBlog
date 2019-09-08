<?php

namespace App\Console;

use App\Console\Commands\Email;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MysqlBackup;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\UpdateArticleSearchIndex::class,
        MysqlBackup::class,
        Email::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('mysql:backup')->everyMinute();
        $schedule->command('inspire')
                 ->hourly();
        $schedule->command('article:search')->twiceDaily(9, 13);
    }
}
