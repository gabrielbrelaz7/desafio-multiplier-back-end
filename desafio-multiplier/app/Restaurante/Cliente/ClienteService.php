<?php

namespace App\Restaurante\Cliente;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class ClienteService implements ClienteServiceInterface
{  

    public function cadastrar($dados)
    {

        $cliente = Cliente::create(array_merge(
            $dados->validated()
        ));

        return [
            'message' => 'Cliente cadastrado com sucesso',
            'cliente' => $cliente
        ];

    }


    public function getPedidos($id)
    {

        $pedidos = Pedido::where('cliente_id', $id)->get();
        
         return [
             'pedidos' => $pedidos
         ];

    }


    public function getMaiorPedido($id)
    {

        $maiorPedido = Pedido::where('cliente_id', $id)->orderBy('total', 'desc')->get()[0];

         return [
             'maiorPedido' => $maiorPedido
         ];

    }


    public function getPrimeiroPedido($id)
    {

        $primeiroPedido = Pedido::where('cliente_id', $id)->orderBy('created_at', 'desc')->get()[0];

         return [
             'primeiroPedido' => $primeiroPedido
         ];

    }

    public function getUltimoPedido($id)
    {

        $ultimoPedido = Pedido::where('cliente_id', $id)->orderBy('created_at', 'asc')->get()[0];

         return [
             'ultimoPedido' => $ultimoPedido
         ];

    }


}
