<?php

namespace Database\Factories;

use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'country' => $this->faker->country(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'vehicle' => $this->faker->randomElement(['bus', 'plane', 'train']),
        ];
    }
}