<?php

namespace App\Restaurante\Pedido;

use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PedidoService implements PedidoServiceInterface
{  

    public function cadastrar($dados)
    {
        try {
            $pedido = new Pedido;

            $produtos = json_decode($dados->validated()['produtos'])->produtos;
            $pedido->cliente_id = $dados->validated()['cliente_id'];
            $pedido->garcom_id = $dados->validated()['garcom_id'];
            $pedido->mesa_id = $dados->validated()['mesa_id'];
            $pedido->produtos = json_encode($produtos);
            $pedido->status = $dados->validated()['cliente_id'];
            $pedido->total = $dados->validated()['total'];
    
            $pedido->save();
            
            return [
                'mensagem' => 'Pedido cadastrado com sucesso',
                'pedido' => $pedido
            ];
   
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }


    public function getPedidos()
    {

        try {
            $pedidos = Pedido::get();

            return [
                'pedidos' => $pedidos
            ];
   
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }



    public function getPedidosPorMesa($mesaID)
    {

        try {
            $pedidosMesa = Pedido::where('mesa_id', $mesaID)->get();

            return [
                'pedidosMesa' => $pedidosMesa
            ];
   
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }


    public function getPedidosPorDia($dia)
    {
        try {
            $pedidosDia = Pedido::whereDate('created_at', $dia)->get();

            return [
                'pedidosDia' => $pedidosDia
            ];
   
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }


    public function getPedidosPorSemana()
    {

        try {
            $now = Carbon::now();
            $primeiroDiaDaSemana = $now->startOfWeek()->format('Y-m-d');
            $ultimoDiaDaSemana = $now->endOfWeek()->format('Y-m-d');
    
            $pedidosSemana = Pedido::whereBetween('created_at', [$primeiroDiaDaSemana, $ultimoDiaDaSemana])->get();
    
            return [
                'pedidosSemana' => $pedidosSemana
            ];
   
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }   


    public function getPedidosPorMes($mes)
    {

        try {
            $pedidosDia = Pedido::whereMonth('created_at', $mes)->get();

            return [
                'pedidosMes' => $pedidosDia
            ];
   
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }


    public function getPedidosGarcom($garcomID)
    {

        try {

            $pedidos = Pedido::where('status', 'em andamento')
            ->where('garcom_id', $garcomID)
            ->get();
    
            return [
                'pedidos' => $pedidos
            ];
   
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }


    public function getPedidosCozinheiro()
    {
        try {

            $pedidos = Pedido::where('status', 'em andamento')
            ->orWhere('status', 'para fazer')->get();
            
             return [
                 'pedidos' => $pedidos
             ];
   
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }

}