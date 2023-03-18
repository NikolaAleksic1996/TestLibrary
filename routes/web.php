<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Models\Book;
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
// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

//Route::get('/', function () {
//    return view('books', [
//        'heading' => 'All books',
//        'books' => Book::all()
//    ]);
//});

Route::get('/', [BookController::class, 'index'])->middleware('auth');
Route::post('/store', [
    BookController::class, 'store'])->name('store')->middleware('auth');
Route::get('/fetch-all', [BookController::class, 'fetchAll'])->name('fetchAll');
Route::post('/edit', [BookController::class, 'edit'])->name('editBook')->middleware('auth');
Route::post('/update', [BookController::class, 'update'])->name('updateBook')->middleware('auth');
Route::delete('/delete', [BookController::class, 'delete'])->name('deleteBook')->middleware('auth');



//got to registration form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
//create new user
Route::post('/users', [UserController::class, 'register']);
//logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');;
//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
