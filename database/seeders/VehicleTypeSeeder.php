<?php

namespace Database\Seeders;

use App\Models\Mileage;
use App\Models\User;
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
            VehicleType::factory(10)->has(
                Vehicle::factory(1))->create();
    }

}
