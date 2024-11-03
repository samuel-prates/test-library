<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;


Route::post('login', [JWTAuthController::class, 'login'])->name('api.login');

// Rota protegida, exige autenticação
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [JWTAuthController::class, 'logout']);
});
