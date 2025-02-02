<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ProdutosTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Factory::create('pt_BR');

        for ($i=1; $i <= 50; $i++) {

            DB::table('produtos')->insert([
                'cardapio_id' => $i,
                'nome' => $faker->word,
                'descricao' => $faker->sentence,
                'preco' => $faker->randomNumber(2, true),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => now()
            ]);
        }
    }
}
