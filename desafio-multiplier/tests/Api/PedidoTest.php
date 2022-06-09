<?php

namespace Tests\Api;

use Tests\TestCase;
use App\Models\User;

class PedidoTest extends TestCase
{

    public function testeCadastrarPedidoSemMiddleware()
    {

        $dados = [
            'cliente_id' => '1',  
            'garcom_id' => '2',
            'mesa_id' => '3',
            'status' => 'para fazer',
            'produtos' => '{produtos: ["Produto1","Produto2"]}',
            'requester' => 'gerente'
        ];

        $response = $this->json('POST', '/api/pedidos/cadastrar',$dados);
        $response->assertStatus(401);
        $response->assertJson(['message' => 'Unauthenticated.']);
        
    }


    public function testeCadastrarPedido()
    {
        $dados = [
            'cliente_id' => '1',  
            'garcom_id' => '2',
            'mesa_id' => '3',
            'status' => 'para fazer',
            'produtos' => '{"produtos": ["Produto1","Produto2"]}',
            'total' => '99',
            'requester' => 'gerente'
        ];
        
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/pedidos/cadastrar',$dados);
        $response->assertStatus(201);
        $response->assertJson(['mensagem' => 'Pedido cadastrado com sucesso']);

    }


    public function testeGetPedidos()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/pedidos/listar?requester=gerente');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['pedidos' =>[
                [
                'id',
                'cliente_id',
                'garcom_id',
                'status',
                'produtos',
                'total',
                'created_at',
                'updated_at'
                ]
            ]]
        );

    }


    public function testeGetPedidosPorMesa()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/pedidos/listar?requester=gerente&mesa=1');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['pedidosMesa' =>[
                [
                'id',
                'cliente_id',
                'garcom_id',
                'status',
                'produtos',
                'total',
                'created_at',
                'updated_at'
                ]
            ]]
        );

    }


    public function testeGetPedidosPorDia()
    {

        $dateNow = date("Y-m-d");
        
        // Para este teste funcionar, é necessário ter um pedido com a data atual
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/pedidos/listar?requester=gerente&dia=' . $dateNow);
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['pedidosDia' =>[
                [
                'id',
                'cliente_id',
                'garcom_id',
                'status',
                'produtos',
                'total',
                'created_at',
                'updated_at'
                ]
            ]]
        );

    }


    public function testeGetPedidosPorSemana()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/pedidos/listar?requester=gerente&semana=true');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['pedidosSemana' =>[
                [
                'id',
                'cliente_id',
                'garcom_id',
                'status',
                'produtos',
                'total',
                'created_at',
                'updated_at'
                ]
            ]]
        );

    }


    public function testeGetPedidosPorMes()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/pedidos/listar?requester=gerente&mes=05');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['pedidosMes' =>[
                [
                'id',
                'cliente_id',
                'garcom_id',
                'status',
                'produtos',
                'total',
                'created_at',
                'updated_at'
                ]
            ]]
        );

    }


    public function testeGetPedidosGarcom()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/pedidos/listar/garcom/1?requester=garcom');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['pedidos' =>[
                [
                'id',
                'cliente_id',
                'garcom_id',
                'status',
                'produtos',
                'total',
                'created_at',
                'updated_at'
                ]
            ]]
        );

        $retorno = $response->getData('pedidos');

        if(count($retorno['pedidos']) ==! 0) {
            $this->assertEquals($retorno['pedidos'][0]['status'], 'em andamento');
        }
    }


    public function testeGetPedidosCozinheiro()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/pedidos/listar/cozinheiro?requester=cozinheiro');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['pedidos' =>[
                [
                'id',
                'cliente_id',
                'garcom_id',
                'status',
                'produtos',
                'total',
                'created_at',
                'updated_at'
                ]
            ]]
        );

        $retorno = $response->getData('pedidos');

        if(count($retorno['pedidos']) ==! 0) {
            $this->assertContains($retorno['pedidos'][0]['status'], ['para fazer', 'em andamento']);
        }
    }

}
