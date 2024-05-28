<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Trip;
use App\Models\TripDate;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        Destination::factory()
            ->count(10)
            ->has(Trip::factory()->count(3))
            ->create();
    }
}