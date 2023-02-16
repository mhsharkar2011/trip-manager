<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CoreappMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:coreapp-migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this to prepare an empty database so that it works with coreapp data';

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
        $this->comment('Importing the following sql file');
        $this->line(database_path('/coreapp-dev-schema.sql'));
        
        DB::unprepared(file_get_contents(database_path('/coreapp-dev-schema.sql')));
        
        $this->comment('Imported coreapp tables');

        //insert migration files in migration tables that has already been created manually
        DB::table('migrations')->insert([
            ['migration' => '2023_01_24_095644_create_projects_table', 'batch' => 1]
            ,['migration' => '2023_02_02_094012_create_permission_tables', 'batch' => 1]
        ]);

        $this->comment('Running artisan migrate now');
        $this->call('migrate');

        return 0;
    }
}
