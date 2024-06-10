<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition()
    {
        $categories = ['Outdoor', 'Indoor', 'Creative', 'Educational'];

        return [
            'name' => $this->faker->sentence(3),
            'category' => $this->faker->randomElement($categories),
        ];
    }
}