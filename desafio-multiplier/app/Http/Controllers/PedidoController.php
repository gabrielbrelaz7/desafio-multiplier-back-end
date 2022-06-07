<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Restaurante\Pedido\PedidoServiceInterface;

class PedidoController extends Controller
{

    private $pedidoService;

    public function __construct(
        PedidoServiceInterface $pedidoService
    ){
        $this->pedidoService = $pedidoService;    
    }
    

    public function cadastrarPedido(Request $request)
    {

        $dados = Validator::make($request->all(), [
            'cliente_id' => 'required|integer',  
            'garcom_id' => 'required|integer',  
            'mesa_id' => 'required|integer',  
            'status' => 'required|string',
            'produtos' => 'required|json',
            'total' => 'required|numeric',
            'requester' => 'required|string'
        ]);
        if($dados->fails()){
            return response()->json($dados->errors()->toJson(), 400);
        }
        else if($request->requester !== 'gerente' || $request->requester !== 'garcom' ){
            return response()->json("Usuário não tem privilégios para realizer esta ação.", 401);
        }
        else{
            $response = $this->pedidoService->cadastrar($dados);
            return response()->json($response, 201);
        }
    }


    public function listarPedidos(Request $request)
    {

        if($request->requester !== 'gerente') {

            if($request->cliente) {
                $response = $this->pedidoService->getPedidosPorCliente($request->cliente);
                return response()->json($response, 200);
            }

            else if($request->mesa) {
                $response = $this->pedidoService->getPedidosPorMesa($request->mesa);
                return response()->json($response, 200);
            }

            else if($request->dia) {
                $response = $this->pedidoService->getPedidosPorDia($request->dia);
                return response()->json($response, 200);
            }

            else if($request->semana === true && $request->semana) {
                $response = $this->pedidoService->getPedidosPorSemana();
                return response()->json($response, 200);
            }
            
            else if($request->mes) {
                $response = $this->pedidoService->getPedidosPorMes($request->mes);
                return response()->json($response, 200);
            }
            
            else{
                $response = $this->pedidoService->getPedidos();
                return response()->json($response, 200);
            }
        }

        else{
            return response()->json("Usuário não tem privilégios para realizer esta ação.", 401);
        }
    }


    public function listarPedidosGarcom($id)
    {

        if($request->requester !== 'gerente' || $request->requester !== 'garcom') {
            $response = $this->pedidoService->getPedidosGarcom($id);
            return response()->json($response, 200);
        }

        else{
            return response()->json("Usuário não tem privilégios para realizer esta ação.", 401);
        }
    }


    public function listarPedidosCozinheiro()
    {
        if($request->requester !== 'gerente' || $request->requester !== 'cozinheiro') {
            $response = $this->pedidoService->getPedidosCozinheiro();
            return response()->json($response, 200);
        }
        else{
            return response()->json("Usuário não tem privilégios para realizer esta ação.", 401)
        }
    }
}
