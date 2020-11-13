<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;


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
// Route::get('', [HomeController::class, 'redirect']);
// Route::get('{foo}', function ($foo) {
//     return $foo;
// });
Route::get('profile', [HomeController::class, 'redirect']);

Route::get('/profile/{id}/', [ProfileController::class, 'profile_view']);

Route::post('profile/add_comment', [CommentController::class, 'Add_comment'])->middleware('auth');
Route::get('profile/all_comments/{id}', [CommentController::class, 'all_comments']);
Route::get('profile/{profile_id}/del_comment/{id}', [CommentController::class, 'del_comment'])->middleware('auth');

// Route::post('profile/add_reply', [CommentController::class, 'Add_reply'])->middleware('auth');

