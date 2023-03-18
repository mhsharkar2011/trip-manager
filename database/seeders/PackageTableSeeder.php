<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            [
                'title' => 'Panama City',
                'slug' => 'panama-city',
                'package_amount' => 3500,
            ],
            [
                'title' => 'Mawa',
                'slug' => 'mawa',
                'package_amount' => 4500,
            ],
            [
                'title' => 'Air Port',
                'slug' => 'air-port',
                'package_amount' => 2500,
            ],
        ]);
    }

    // public function run()
    // {
    //     // Create three packages
    //     $packages = [
    //         [
    //             'title' => 'Bronze Package',
    //             'slug' => 'bronze-package',
    //             'package_amount' => 5000
    //         ],
    //         [
    //             'title' => 'Silver Package',
    //             'slug' => 'silver-package',
    //             'package_amount' => 10000
    //         ],
    //         [
    //             'title' => 'Gold Package',
    //             'slug' => 'gold-package',
    //             'package_amount' => 15000
    //         ]
    //     ];

    //     // Loop through the packages and create each one
    //     foreach ($packages as $package) {
    //         Package::create($package);
    //     }
    // }
}
