<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::all()->groupBy('country');
        return view('trips.index', compact('trips'));
    }

    public function showByCountry($country)
    {
        $trips = Trip::where('country', $country)->get();
        return view('trips.show', compact('trips', 'country'));
    }
}