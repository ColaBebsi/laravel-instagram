<?php

use App\Http\Controllers\FollowsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::post('follow/{user}', [FollowsController::class , 'store']);

// Profile
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

// Post
Route::get('/', [PostController::class, 'index']);
Route::get('/post/create', [PostController::class, 'create']);
Route::post('/post', [PostController::class, 'store']);
Route::get('/post/{post}', [PostController::class, 'show']);