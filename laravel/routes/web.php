<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\LoginController;

Route::prefix('v1')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        // login
        Route::post('/login','login');
        // logout
        Route::post('/logout','logout');
        // me
        Route::get('/me','me')->middleware('jwtCheck');
    });





});


