<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // VehicleType::factory(10)->create();       

        $vehicletypes = ['Bus', 'Micro Bus', 'Private Car'];

        foreach($vehicletypes as $vehicletype) {
            VehicleType::factory()->create([
                'title' => $vehicletype,
                'created_at'=>'2023-01-11'
                ]);
            }
    }
}
