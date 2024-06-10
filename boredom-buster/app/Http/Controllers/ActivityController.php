<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activity = Activity::inRandomOrder()->first();
        return view('welcome', compact('activity'));
    }

    public function category($category)
    {
        $activity = Activity::where('category', $category)->inRandomOrder()->first();
        return view('category', compact('activity', 'category'));
    }
}
