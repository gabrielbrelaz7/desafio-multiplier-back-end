<?php

namespace Tests\Api;

use Tests\TestCase;
use App\Models\User;


class CardapioTest extends TestCase
{

    public function testeCadastrarCardapioSemMiddleware()
    {

        $dados = [
            'nomeCardapio' => 'Cardapio 100',
            'nomeProduto' => '{"produtos":["Produto1","Produto2"]}',
            'precoProduto' => '{"precos":["90","34"]}',
            'descricaoProduto' => '{"descricoes":["Descricao1","Descricao2"]}',
            'requester' => 'gerente'
        ];

        $response = $this->json('POST', '/api/cardapios/cadastrar', $dados);
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
        
    }


    public function testeCadastrarCardapio()
    {
        $dados = [
            'nomeCardapio' => 'Cardapio 100',
            'nomeProduto' => '{"produtos":["Produto1","Produto2"]}',
            'precoProduto' => '{"precos":["90","34"]}',
            'descricaoProduto' => '{"descricoes":["Descricao1","Descricao2"]}',
            'requester' => 'gerente'
        ];
        
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/cardapios/cadastrar', $dados);
        $response->assertStatus(201);
        $response->assertJson(['mensagem' => 'Cardapio cadastrado com sucesso']);

        $response->assertJsonStructure([
            
            'mensagem',
            'cardapio' => [
                'nome',
                'updated_at',
                'created_at',
                'id'
            ],
            'produtos' => [[
                'id',
                'cardapio_id',
                'nome',
                'descricao',
                'preco',
                'updated_at',
                'created_at',
            ]]
            ]   
        );

    }
}
