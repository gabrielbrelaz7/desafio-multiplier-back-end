<?php

namespace Tests\Api;

use Tests\TestCase;
use App\Models\User;


class UserTest extends TestCase
{

    public function testeCadastrarUsuarioSemMiddleware()
    {

        $dados = [
            'name' => 'Gabriel Brelaz',
            'email' => 'gabrielbrelaz@gmail.com',
            'type' => 'gerente',
            'requester' => 'gerente',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->json('POST', '/api/usuarios', $dados);
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
        
    }


    public function testeCadastrarGarcom()
    {
        $dados = [
            'name' => 'Gabriel Brelaz',
            'email' => 'garcom23@gmail.com',
            'type' => 'garcom',
            'requester' => 'gerente',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];
        
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/usuarios', $dados);
        $response->assertStatus(201);
        $response->assertJson(['mensagem' => 'Usuário cadastrado com sucesso']);

    }


    public function testeCadastrarCozinheiro()
    {
        $dados = [
            'name' => 'Gabriel Brelaz',
            'email' => 'cozinheiro23@gmail.com',
            'type' => 'cozinheiro',
            'requester' => 'gerente',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];
        
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/usuarios', $dados);
        $response->assertStatus(201);
        $response->assertJson(['mensagem' => 'Usuário cadastrado com sucesso']);

    }

}
