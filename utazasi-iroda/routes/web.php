<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\TripController;

Route::get('/', [TripController::class, 'index'])->name('trips.index');
Route::get('/country/{country}', [TripController::class, 'showByCountry'])->name('trips.showByCountry');
