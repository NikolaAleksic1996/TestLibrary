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

//BOOKS ROUTES
Route::get('/', [BookController::class, 'index'])->middleware(['auth', 'isLibrarian']);
Route::post('/store', [
    BookController::class, 'store'])->name('store')->middleware(['auth', 'isLibrarian']);
Route::get('/fetch-all', [BookController::class, 'fetchAll'])->name('fetchAll');
Route::post('/edit', [BookController::class, 'edit'])->name('editBook')->middleware(['auth', 'isLibrarian']);
Route::post('/update', [BookController::class, 'update'])->name('updateBook')->middleware(['auth', 'isLibrarian']);
Route::delete('/delete', [BookController::class, 'delete'])->name('deleteBook')->middleware(['auth', 'isLibrarian']);
//BOOKS ROUTES

//AUTHOR ROUTES
Route::get('/fetch-all-authors', [\App\Http\Controllers\AuthorController::class, 'fetchAll'])->name('fetchAllAuthors');
//AUTHOR ROUTES

//AUTH ROUTES
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
//AUTH ROUTES

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
