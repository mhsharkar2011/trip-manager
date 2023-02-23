<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CoreappMigrateLocal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:coreapp-migrate-local';

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
        //server
        //enter projects in migrations
        //delete table: roles, permissions
        //add tenant_id int(10) nullable in projects table
        //UPDATE `projects` set tenant_id=company_id;


        $this->comment('Importing the following sql file');
        $this->line(database_path('/coreapp-dev-schema.sql'));
        
        DB::unprepared(file_get_contents(database_path('/coreapp-dev-schema.sql')));
        
        $this->comment('Imported coreapp tables');

        //insert migration files in migration tables that has already been created manually
        DB::table('migrations')->insert([
            ['migration' => '2023_01_24_095644_create_projects_table', 'batch' => 1]
            // ,['migration' => '2023_02_02_094012_create_permission_tables', 'batch' => 1]
        ]);

        DB::statement('DROP TABLE `roles`'); //seems to be unused and conflicts with boilerplate role permission tables

        $this->comment('Running artisan migrate now');
        $this->call('migrate');

        $this->comment('Making some users table column nullable');

        DB::statement('ALTER TABLE `users` CHANGE `usertype` `usertype` int NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `user_roles` `user_roles` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL');
        DB::statement('ALTER TABLE `users` CHANGE `address` `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `area` `area` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `city_id` `city_id` int NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `district_province` `district_province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `name` `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;');

        $this->comment('All Done!');
        
        $this->comment('If you need Coreapp data locally, import all table data without migrations table data and start import after setting "SET foreign_key_checks = 0;" first.');
        
        return 0;
    }
}
