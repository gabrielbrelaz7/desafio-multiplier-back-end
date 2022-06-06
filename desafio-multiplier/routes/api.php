<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FakerController;


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

Route::get('faker/clientes/{quantidade}', [FakerController::class, 'cadastrarClientes']);
Route::get('faker/cardapios/{quantidade}', [FakerController::class, 'cadastrarCardapios']);
Route::get('faker/produtos/{quantidade}', [FakerController::class, 'cadastrarProdutos']);
Route::get('faker/pedidos/{quantidade}', [FakerController::class, 'cadastrarPedidos']);
