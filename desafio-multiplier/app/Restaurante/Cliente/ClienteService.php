<?php

namespace App\Restaurante\Cliente;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class ClienteService implements ClienteServiceInterface
{  

    public function cadastrar($dados)
    {

        try {
            $cliente = Cliente::create(array_merge(
                $dados->validated()
            ));
    
            return [
                'mensagem' => 'Cliente cadastrado com sucesso',
                'cliente' => $cliente
            ];
    
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }


    public function getPedidos($id)
    {

         try {
            $pedidos = Pedido::where('cliente_id', $id)->get();
        
            return [
                'pedidos' => $pedidos
            ];
    
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }


    public function getMaiorPedido($id)
    {

         try {
            $maiorPedido = Pedido::where('cliente_id', $id)->orderBy('total', 'desc')->get()->first();

            return [
                'maiorPedido' => $maiorPedido
            ];
   
    
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }


    public function getPrimeiroPedido($id)
    {

         try {
            $primeiroPedido = Pedido::where('cliente_id', $id)->orderBy('created_at', 'desc')->get()->first();

            return [
                'primeiroPedido' => $primeiroPedido
            ];
   
    
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }

    public function getUltimoPedido($id)
    {

         try {
            $ultimoPedido = Pedido::where('cliente_id', $id)->orderBy('created_at', 'asc')->get()->first();

            return [
                'ultimoPedido' => $ultimoPedido
            ];
   
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    
    }


}
