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
            'total' => 'required|numeric'
        ]);
        if($dados->fails()){
            return response()->json($dados->errors()->toJson(), 400);
        }
        else{
            $response = $this->pedidoService->cadastrar($dados);
            return response()->json($response, 201);
        }
    }


    public function listarPedidos(Request $request)
    {

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


    public function listarPedidosGarcom()
    {
        $response = $this->pedidoService->getPedidosGarcom();
        return response()->json($response, 200);
    }


    public function listarPedidosCozinheiro()
    {
        $response = $this->pedidoService->getPedidosCozinheiro();
        return response()->json($response, 200);
    }
}
