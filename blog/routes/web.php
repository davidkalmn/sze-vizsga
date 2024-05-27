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
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/{user?}', [PostController::class, 'allPosts'])->name('home');
Route::get('/users/{user}/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/users/{user}/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/users/{user}/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/users/{user}/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/users/{user}/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
