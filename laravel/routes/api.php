<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users',[\App\Http\Controllers\UserController::class,'list']);

Route::get('/user/{user}',[\App\Http\Controllers\UserController::class,'show']);

Route::delete('/user/{user}',[\App\Http\Controllers\UserController::class,'delete']);
