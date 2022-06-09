<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;


class TestesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Factory::create('pt_BR');

        DB::table('users')->insert([
            'name' => 'Gerente',
            'email' => 'gerente@restaurante.com.br',
            'type' => 'gerente',
            'password' => bcrypt('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);


        for ($i=1; $i <= 5; $i++) {
        
            DB::table('users')->insert([
                'name' => 'Garçom ' . $i,
                'email' => 'garcom'.$i.'@restaurante.com.br',
                'type' => 'garcom',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }


        for ($i=1; $i <= 2; $i++) {
        
            DB::table('users')->insert([
                'name' => 'Cozinheiro ' . $i,
                'email' => 'cozinheiro'.$i.'@restaurante.com.br',
                'type' => 'cozinheiro',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }


        for ($i=1; $i <= 10; $i++) {
        
            DB::table('mesas')->insert([
                'mesas' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }


        for ($i=1; $i <= 100; $i++) {

            DB::table('clientes')->insert([
                'nome' => $faker->firstName,
                'sobrenome' => $faker->lastName,
                'cpf' => $faker->randomNumber(9, true),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => now()
            ]);
        }


        for ($i=1; $i <= 20; $i++) {

            DB::table('cardapios')->insert([
                'nome' => $faker->word,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }


        for ($i=1; $i <= 20; $i++) {

            DB::table('produtos')->insert([
                'cardapio_id' => $i,
                'nome' => $faker->word,
                'descricao' => $faker->sentence,
                'preco' => $faker->randomNumber(2, true),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => now()
            ]);
        }


        for ($i=1; $i <= 1; $i++) {

            DB::table('pedidos')->insert([
                'cliente_id' => 1,
                'garcom_id' => $faker->numberBetween(1, 5),
                'mesa_id' => $faker->numberBetween(1, 10),
                'status' => $faker->randomElement(['para fazer', 'em andamento']),
                'produtos' => json_encode($faker->words(3)),
                'total' => $faker->randomNumber(2, true),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        for ($i=1; $i <= 9; $i++) {

            DB::table('pedidos')->insert([
                'cliente_id' => 1,
                'garcom_id' => $faker->numberBetween(1, 5),
                'mesa_id' => $faker->numberBetween(1, 10),
                'status' => $faker->randomElement(['para fazer', 'em andamento']),
                'produtos' => json_encode($faker->words(3)),
                'total' => $faker->randomNumber(2, true),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => now()
            ]);
        }

        for ($i=1; $i <= 40; $i++) {

            DB::table('pedidos')->insert([
                'cliente_id' => $faker->numberBetween(1, 100),
                'garcom_id' => $faker->numberBetween(1, 5),
                'mesa_id' => $faker->numberBetween(1, 10),
                'status' => $faker->randomElement(['para fazer', 'em andamento']),
                'produtos' => json_encode($faker->words(3)),
                'total' => $faker->randomNumber(2, true),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => now()
            ]);
        }

        for ($i=1; $i <= 350; $i++) {

            DB::table('pedidos')->insert([
                'cliente_id' => $faker->numberBetween(1, 100),
                'garcom_id' => $faker->numberBetween(1, 5),
                'mesa_id' => $faker->numberBetween(1, 10),
                'status' => $faker->randomElement(['feito']),
                'produtos' => json_encode($faker->words(3)),
                'total' => $faker->randomNumber(2, true),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => now()
            ]);
        }

    }
}
