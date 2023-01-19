<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $sl_no = "s";
        static $model = "m";
        static $license_no = "dha-";
                return [
                    'sl_no' => $sl_no."-".rand(6,10000),
                    'name' => $this->faker->name,
                    'model' => $model."-".Str::random(4),
                    'tank_capacity' => '200',
                    'license_no' => $license_no.rand(8,100000000)
                ];
    }
}
