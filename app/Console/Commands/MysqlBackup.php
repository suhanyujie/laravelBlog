<?php

namespace App\Console\Commands;

use App\Service\Article\MysqlToolService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class MysqlBackup extends Command implements SelfHandling
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '备份博客的数据库。';

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
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        MysqlToolService::backup();
    }
}
