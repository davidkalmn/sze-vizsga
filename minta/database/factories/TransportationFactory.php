<?php

namespace Database\Factories;

use App\Models\Transportation;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportationFactory extends Factory
{
    protected $model = Transportation::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Autó', 'Busz', 'Repülő']),
        ];
    }
}
