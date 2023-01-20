<?php

namespace Database\Factories;

use App\Models\Fuel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FuelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fuel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'volume'=>rand(100,10000),
            'cost'=>rand(100,10000),
            'gas_station'=>Str::random(16),
        ];
    }
}
