<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthorController;
use \App\Http\Controllers\BookController;
use \App\Http\Controllers\LoanController;
use \Tymon\JWTAuth\Facades\JWTAuth;
use \App\Http\Controllers\JWTAuthController;

Route::get('/', function () {
    return view('welcome')->with('token', JWTAuth::getToken());
})->name('welcome');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::controller(AuthorController::class)->group(function () {
    Route::get('/author', 'index')->name('author.index');
    Route::get('/author/new', 'create')->name('author.create');
    Route::get('/author/show/{author}', 'show')->name('author.show');
    Route::get('/author/update/{author}', 'edit')->name('author.edit');
    Route::post('/author', 'store')->name('author.store');
    Route::put('/author/{author}', 'update')->name('author.update');
    Route::delete('/author/{author}', 'destroy')->name('author.destroy');
});

Route::controller(BookController::class)->group(function () {
    Route::get('/book', 'index')->name('book.index');
    Route::get('/book/new', 'create')->name('book.create');
    Route::get('/book/show/{book}', 'show')->name('book.show');
    Route::get('/book/update/{book}', 'edit')->name('book.edit');
    Route::post('/book', 'store')->name('book.store');
    Route::put('/book/{book}', 'update')->name('book.update');
    Route::delete('/book/{book}', 'destroy')->name('book.destroy');
});

Route::controller(LoanController::class)->group(function () {
    Route::get('/loan', 'index')->name('loan.index');
    Route::get('/loan/new', 'create')->name('loan.create');
    Route::get('/loan/show/{loan}', 'show')->name('loan.show');
    Route::post('/loan', 'store')->name('loan.store');
});

Route::controller(JWTAuthController::class)->group(function () {
    Route::get('/user', 'index')->name('user.index');
    Route::get('/user/new', 'create')->name('user.create');
    Route::post('register', 'register')->name('user.register');
    Route::delete('/user/destroy/{user}', 'destroy')->name('user.destroy');
});
