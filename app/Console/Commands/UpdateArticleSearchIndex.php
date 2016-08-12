<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateArticleSearchIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:search';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成文章的全文索引';

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
        //echo 123;
        exec('/usr/local/coreseek/bin/indexer -c /usr/local/coreseek/etc/laravel.conf --all --rotate',$res);
        var_dump($res);
    }
}
