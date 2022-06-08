<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\PedidoController;


use App\Http\Controllers\FakerController;


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']); 
        Route::get('me', [AuthController::class, 'me']);    
    });
});


Route::group(['prefix' => 'usuarios'], function () {
    Route::group(['middleware' => 'auth:api'], function () {  
        Route::post('cadastrar', [UserController::class, 'cadastrarUsuario']); 
        Route::get('listar', [UserController::class, 'listarUsuarios']); 
        Route::put('atualizar/{id}', [UserController::class, 'atualizarUsuario']); 
    });
});



Route::group(['prefix' => 'clientes'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('cadastrar', [ClienteController::class, 'cadastrarCliente']);
        Route::get('listar/{id}', [ClienteController::class, 'listarPedidos']);
    });
});


Route::group(['prefix' => 'pedidos'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('cadastrar', [PedidoController::class, 'cadastrarPedido']);
        Route::get('listar/garcom/{id}', [PedidoController::class, 'listarPedidosGarcom']);
        Route::get('listar/cozinheiro', [PedidoController::class, 'listarPedidosCozinheiro']);
        Route::get('listar', [PedidoController::class, 'listarPedidos']);
    });
});


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('mesas/cadastrar', [MesaController::class, 'cadastrarMesa']);
    Route::post('cardapios/cadastrar', [CardapioController::class, 'cadastrarCardapio']);
});



// Caso precise utilizar Faker PHP como requisição na API
    // Route::get('faker/clientes/{quantidade}', [FakerController::class, 'cadastrarClientes']);
    // Route::get('faker/cardapios/{quantidade}', [FakerController::class, 'cadastrarCardapios']);
    // Route::get('faker/produtos/{quantidade}', [FakerController::class, 'cadastrarProdutos']);
    // Route::get('faker/pedidos/{quantidade}', [FakerController::class, 'cadastrarPedidos']);
