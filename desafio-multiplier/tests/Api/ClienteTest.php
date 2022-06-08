<?php

namespace Tests\Api;

use Tests\TestCase;
use App\Models\User;


class ClienteTest extends TestCase
{

    public function testeCadastrarClienteSemMiddleware()
    {

        $dados = [
            'nome' => 'Nome',  
            'sobrenome' => 'Sobrenome',
            'cpf' => '22222222222',
            'requester' => 'gerente'
        ];

        $response = $this->json('POST', '/api/clientes/cadastrar',$dados);
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
        
    }


    public function testeCadastrarCliente()
    {
        $dados = [
            'nome' => 'Nome',  
            'sobrenome' => 'Sobrenome',
            'cpf' => '22222222222',
            'requester' => 'gerente'
        ];
        
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/clientes/cadastrar',$dados);
        $response->assertStatus(201);
        $response->assertJson(['mensagem' => 'Cliente cadastrado com sucesso']);

    }


    public function testeGetPedidos()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/clientes/listar/257?requester=gerente');
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


    public function testeGetMaiorPedido()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/clientes/listar/257?requester=gerente&maior=true');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['maiorPedido' =>
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
            ]
        );

    }


    public function testeGetPrimeiroPedido()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/clientes/listar/257?requester=gerente&primeiro=true');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['primeiroPedido' =>
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
            ]
        );

    }



    public function testeGetUltimoPedido()
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/clientes/listar/257?requester=gerente&ultimo=true');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            ['ultimoPedido' =>
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
            ]
        );

    }

}
