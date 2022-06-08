<?php

namespace Tests\Api;

use Tests\TestCase;
use App\Models\User;


class MesaTest extends TestCase
{

    public function testeCadastrarMesaSemMiddleware()
    {

        $dados = [
            'mesas' => '100',
            'requester' => 'gerente'
        ];

        $response = $this->json('POST', '/api/mesas/cadastrar', $dados);
        $response->assertStatus(401);
        $response->assertJson(['message' => 'Unauthenticated.']);
        
    }


    public function testeCadastrarMesa()
    {
        $dados = [
            'mesas' => '100',
            'requester' => 'gerente'
        ];
        
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/mesas/cadastrar',$dados);
        $response->assertStatus(201);
        $response->assertJson(['mensagem' => 'Mesa cadastrada com sucesso']);

    }


}
