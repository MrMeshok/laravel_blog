<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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
Route::view('', 'welcome');

Route::get('/profile/{id}', [ProfileController::class, 'profile_view']);

Route::post('profile/add_comment', [ProfileController::class, 'comments']);
// Route::view('profile', 'home');
// Route::view('home', 'home')->middleware('auth');
