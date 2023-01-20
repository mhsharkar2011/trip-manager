<?php

namespace Database\Seeders;

use App\Models\Mileage;
use App\Models\Vehicle;
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
            VehicleType::factory(5)->has(
                Vehicle::factory(2)->has(
                    Mileage::factory(1)
                )
            )->create();
    }

}
