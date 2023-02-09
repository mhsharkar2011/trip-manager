<?php

namespace Database\Factories;

use App\Models\Mileage;
use Illuminate\Database\Eloquent\Factories\Factory;

class MileageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mileage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total_mileage'=>rand(4,1000),
        ];
    }
}
