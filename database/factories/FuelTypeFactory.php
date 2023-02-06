<?php

namespace Database\Factories;

use App\Models\FuelType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuelTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FuelType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
