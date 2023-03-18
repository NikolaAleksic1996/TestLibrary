<?php

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

//Route::get('/', function () {
//    return view('books', [
//        'heading' => 'All books',
//        'books' => Book::all()
//    ]);
//});

Route::get('/', [\App\Http\Controllers\BookController::class, 'index']);
Route::post('/store', [\App\Http\Controllers\BookController::class, 'store'])->name('store');
Route::get('/fetch-all', [\App\Http\Controllers\BookController::class, 'fetchAll'])->name('fetchAll');
Route::post('/edit', [\App\Http\Controllers\BookController::class, 'edit'])->name('editBook');
Route::post('/update', [\App\Http\Controllers\BookController::class, 'update'])->name('updateBook');
Route::delete('/delete', [\App\Http\Controllers\BookController::class, 'delete'])->name('deleteBook');




//Route::get('/books/{id}', function ($id) {
//    return view('book', [
//        'book' => Book::find($id)
//    ]);
//});

Route::get('/register', [UserController::class, 'create']);

//create new user
Route::post('/users', [UserController::class, 'register']);
