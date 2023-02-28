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
    protected $description = 'Run this on a server that is connected to coreapp database, this will make adjustments to it for boilerplate compatibility';

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
        $this->comment('Inserting rows in migrations table that were created manually');
        DB::table('migrations')->insert([
            ['migration' => '2023_01_24_095644_create_projects_table', 'batch' => 1]
        ]);
        
        $this->comment('Dropping conflicting tables');
        DB::statement('DROP TABLE IF EXISTS `roles`'); //seems to be unused and conflicts with boilerplate role permission tables
        DB::statement('DROP TABLE IF EXISTS `permissions`'); //seems to be unused and conflicts with boilerplate role permission tables

        $this->comment('Running boilerplate migrate now');
        $this->call('migrate');

        $this->comment('Adding tenant_id to projects table');
        DB::statement('ALTER TABLE `projects` ADD `tenant_id` INT(10) NULL DEFAULT NULL AFTER `avatar_directory`'); 
        DB::statement('UPDATE `projects` set tenant_id=company_id;'); 
        
        $this->comment('Copying companies to tenants');
        DB::statement('TRUNCATE TABLE `tenants`');
        DB::statement('INSERT INTO tenants (id, name) select c.id, c.company_name from companies c;'); 

        $this->comment('Making some users table column nullable');
        DB::statement('ALTER TABLE `users` CHANGE `usertype` `usertype` int NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `user_roles` `user_roles` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL');
        DB::statement('ALTER TABLE `users` CHANGE `address` `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `area` `area` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `city_id` `city_id` int NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `district_province` `district_province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;');
        DB::statement('ALTER TABLE `users` CHANGE `name` `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;');

        $this->comment('All Done!');
        
        return 0;
    }
}
