<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;


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
Route::get('', [HomeController::class, 'redirect']);
// Route::get('{foo}', function ($foo) {
//     return $foo;
// });
Route::get('profile', [HomeController::class, 'redirect']);
Route::get('HOME', [HomeController::class, 'redirect']);

Route::get('/profile/{user_id}/', [ProfileController::class, 'profile_view']);
Route::get('/users', [ProfileController::class, 'all_users']);

Route::get('/user_comments', [CommentController::class, 'user_comments'])->middleware('auth');

Route::get('/library/{user_id}', [LibraryController::class, 'library'])->middleware('ShareableLibrary');
Route::get('/library/{user_id}/{book_id}', [LibraryController::class, 'read_book'])->middleware('ShareableLibrary');
Route::get('/library/{user_id}/change_public', [LibraryController::class, 'change_public'])->middleware('auth');
Route::post('/library/{user_id}/add_book', [LibraryController::class, 'add_book'])->middleware('auth');
Route::get('/profile/{user_id}/share_library', [LibraryController::class, 'share_library'])->middleware('auth');
Route::get('/library/{user_id}/{book_id}/del_book', [LibraryController::class, 'del_book'])->middleware('auth');
Route::post('/library/{user_id}/{book_id}/edit_book', [LibraryController::class, 'edit_book'])->middleware('auth');


Route::post('/profile/add_comment', [CommentController::class, 'Add_comment'])->middleware('auth');
Route::get('/profile/all_comments/{user_id}', [CommentController::class, 'all_comments']);
Route::get('/profile/del_comment/{id}', [CommentController::class, 'del_comment'])->middleware('auth');

// Route::post('profile/add_reply', [CommentController::class, 'Add_reply'])->middleware('auth');

