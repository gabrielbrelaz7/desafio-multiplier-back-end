<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Restaurante\Cliente\ClienteServiceInterface;

class ClienteController extends Controller
{

    private $clienteService;

    public function __construct(
        ClienteServiceInterface $clienteService
    ){
        $this->clienteService = $clienteService;    
    }

    public function cadastrarCliente(Request $request)
    {

        $dados = Validator::make($request->all(), [
            'nome' => 'required|string|between:2,100',  
            'sobrenome' => 'required|string|between:2,100',
            'cpf' => 'required|string|between:11,11',
        ]);
        if($dados->fails()){
            return response()->json($dados->errors()->toJson(), 400);
        }
        else{
            $response = $this->clienteService->cadastrar($dados);
            return response()->json($response, 201);
        }
    }
}
