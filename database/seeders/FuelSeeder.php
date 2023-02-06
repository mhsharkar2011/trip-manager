<?php

namespace Database\Seeders;

use App\Models\Fuel;
use App\Models\FuelType;
use App\Models\Mileage;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FuelType::factory(5)->has(
            Fuel::factory(2)->has(
                Vehicle::factory(1)
            )
        )->create();
    }
}
