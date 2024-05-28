<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $destinations = Destination::with('trips.transportation')->paginate(10);
        return view('index', compact('destinations'));
    }

    public function show(Destination $destination)
    {
        $destination->load('trips.tripDates');
        return view('show', compact('destination'));
    }
}
