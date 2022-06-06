<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']); 
        Route::post('me', [AuthController::class, 'me']);    
    });
});


Route::group(['middleware' => 'auth:api'], function () {   
    Route::post('usuarios', [UserController::class, 'register']);
    Route::get('usuarios', [UserController::class, 'get']); 
    Route::patch('usuarios/{id}', [UserController::class, 'update']); 
});