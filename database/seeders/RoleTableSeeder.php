<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'guard_name' => 'Admin'
            ],
            [
                'name' => 'Driver',
                'guard_name' => 'Driver'
            ],
            [
                'name' => 'Customer',
                'guard_name' => 'Customer'
            ],
            [
                'name' => 'Owner',
                'guard_name' => 'Owner'
            ],
        ]);
    }
}
