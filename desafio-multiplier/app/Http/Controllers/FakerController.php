<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\Request;
use DB;

class FakerController extends Controller
{
    public function cadastrarClientes($quantidade) 
    {
        $faker = Factory::create('pt_BR');

        for ($i=1; $i <= $quantidade; $i++) {

            DB::table('clientes')->insert([
                'nome' => $faker->firstName,
                'sobrenome' => $faker->l,
                'email' => $faker->email,
                'celular' => $faker->phoneNumber,
            ]);
        }
    }


    public function cadastrarCardapios($quantidade) 
    {
        $faker = Factory::create('pt_BR');

        for ($i=1; $i <= $quantidade; $i++) {

            DB::table('cardapios')->insert([
                'nome' => $faker->word
            ]);
        }
    }


    public function cadastrarProdutos($quantidade) 
    {
        $faker = Factory::create('pt_BR');

        for ($i=1; $i <= $quantidade; $i++) {

            DB::table('produtos')->insert([
                'cardapio_id' => $i,
                'nome' => $faker->word,
                'descricao' => $faker->sentence,
                'preco' => $faker->randomNumber(2, true)
            ]);
        }
    }


    public function cadastrarPedidos($quantidade) 
    {
        $faker = Factory::create('pt_BR');

        for ($i=1; $i <= $quantidade; $i++) {

            DB::table('pedidos')->insert([
                'cliente_id' => $faker->numberBetween(1, 10000),
                'garcom_id' => $faker->numberBetween(1, 5),
                'mesa_id' => $faker->numberBetween(1, 20),
                'status' => $faker->randomElement(['para fazer', 'em andamento', 'feito']),
                'produtos' => json_encode($faker->words(3)),
                'total' => $faker->randomNumber(3, true)
            ]);
        }
    }
}
