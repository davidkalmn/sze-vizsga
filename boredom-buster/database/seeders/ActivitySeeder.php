<?php

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Outdoor', 'Indoor', 'Creative', 'Educational'];
        
        foreach ($categories as $categoryName) {
            for ($i = 1; $i <= 5; $i++) {
                Activity::create([
                    'name' => "$categoryName Activity $i",
                    'category' => $categoryName
                ]);
            }
        }
    }
}
