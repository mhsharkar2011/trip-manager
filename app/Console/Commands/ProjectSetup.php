<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ProjectSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up the project for local dev';

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
     * @return int
     */
    public function handle()
    {
        // if (app()->environment() === 'production') {
        //     $this->error('You cannot run this command in production mode, exiting.');
        //     return 1;
        // }
        
        if (! File::exists('.env')) {
            File::copy('.env.example', '.env');
            $this->info('.env created from .env.example');

            exec("sed -i -r 's/SUPERADMIN_AUTO_LOGIN=false/SUPERADMIN_AUTO_LOGIN=true/' .env");
        }

        $this->call('migrate', [
            '--force' => '',
            '--seed' => '',
        ]);

        $this->call('storage:link');
        
        exec('chmod -R 777 storage bootstrap/cache');
        
        return 0;
    }
}
