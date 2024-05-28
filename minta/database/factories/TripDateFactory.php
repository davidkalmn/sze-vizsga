<?php

namespace Database\Factories;

use App\Models\TripDate;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripDateFactory extends Factory
{
    protected $model = TripDate::class;

    public function definition()
    {
        return [
            'trip_id' => Trip::factory(),
            'date' => $this->faker->date(),
        ];
    }
}
