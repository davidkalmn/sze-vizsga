<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\Destination;
use App\Models\Transportation;
use App\Models\TripDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        return [
            'destination_id' => Destination::factory(),
            'transportation_id' => Transportation::factory(),
            'price' => $this->faker->randomFloat(0, 100000, 200000),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Trip $trip) {
            TripDate::factory()->count(1)->create(['trip_id' => $trip->id]);
        });
    }
}
