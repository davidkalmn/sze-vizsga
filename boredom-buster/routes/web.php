<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

Route::get('/', [ActivityController::class, 'index'])->name('home');
Route::get('/category/{category}', [ActivityController::class, 'category'])->name('category');
