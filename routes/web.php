<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::get('/',HomeController::class)->name('home');

Route::resource('users',UserController::class);
Route::get('user/{id}/posts',[UserController::class,'posts'])->name('user.posts');

Route::resource('posts',PostController::class);
Route::get('posts/search/new',[PostController::class,'search'])->name('posts.search');

Route::resource('tags',TagController::class);