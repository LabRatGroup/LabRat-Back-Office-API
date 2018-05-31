<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DevBuild extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild DB with dev content';

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
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        Artisan::call('db:seed', [
            '--class' => 'DevSeeder'
        ]);
    }
}
