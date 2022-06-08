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
            'requester' => 'required|string'
        ]);
        if($dados->fails()){
            return response()->json($dados->errors()->toJson(), 400);
        }
        else if($request->requester !== 'gerente'){
            return response()->json("Usuário não tem privilégios para realizer esta ação.", 401);
        }
        else{
            $response = $this->clienteService->cadastrar($dados);
            return response()->json($response, 201);
        }
    }


    public function listarPedidos(Request $request)
    {

        if($request->requester === 'gerente'){
        
            if($request->maior == true && $request->maior) {
                $response = $this->clienteService->getMaiorPedido($request->id);
                return response()->json($response, 200);
            }

            else if($request->primeiro == true && $request->primeiro) {
                $response = $this->clienteService->getPrimeiroPedido($request->id);
                return response()->json($response, 200);
            }

            else if($request->ultimo == true && $request->ultimo) {
                $response = $this->clienteService->getUltimoPedido($request->id);
                return response()->json($response, 200);
            }
            
            else{
                $response = $this->clienteService->getPedidos($request->id);
                return response()->json($response, 200);
            }
        }

        else {
            return response()->json("Usuário não tem privilégios para realizer esta ação.", 401);
        }
    }

}
