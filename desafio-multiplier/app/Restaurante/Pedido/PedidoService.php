<?php

namespace App\Restaurante\Pedido;

use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PedidoService implements PedidoServiceInterface
{  

    public function cadastrar($dados)
    {

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

    }


    public function getPedidos()
    {

        $pedidos = Pedido::get();

        return [
            'pedidos' => $pedidos
        ];

    }



    public function getPedidosPorMesa($mesaID)
    {

        $pedidosMesa = Pedido::where('mesa_id', $mesaID)->get();

        return [
            'pedidosMesa' => $pedidosMesa
        ];

    }


    public function getPedidosPorDia($dia)
    {

        $pedidosDia = Pedido::whereDate('created_at', $dia)->get();

        return [
            'pedidosDia' => $pedidosDia
        ];

    }


    public function getPedidosPorSemana()
    {

        $now = Carbon::now();
        $primeiroDiaDaSemana = $now->startOfWeek()->format('Y-m-d');
        $ultimoDiaDaSemana = $now->endOfWeek()->format('Y-m-d');

        $pedidosSemana = Pedido::whereBetween('created_at', [$primeiroDiaDaSemana, $ultimoDiaDaSemana])->get();

        return [
            'pedidosSemana' => $pedidosSemana
        ];

    }   


    public function getPedidosPorMes($mes)
    {

        $pedidosDia = Pedido::whereMonth('created_at', $mes)->get();

        return [
            'pedidosMes' => $pedidosDia
        ];

    }


    public function getPedidosGarcom($garcomID)
    {

        $pedidos = Pedido::where('status', 'em andamento')
        ->where('garcom_id', $garcomID)
        ->get();

        return [
            'pedidos' => $pedidos
        ];

    }


    public function getPedidosCozinheiro()
    {

       $pedidos = Pedido::where('status', 'em andamento')
       ->orWhere('status', 'para fazer')->get();
       
        return [
            'pedidos' => $pedidos
        ];

    }

}