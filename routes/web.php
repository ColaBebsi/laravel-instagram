<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Profile
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.show')->middleware('auth');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Post
Route::get('/post/create', [PostController::class, 'create']);
