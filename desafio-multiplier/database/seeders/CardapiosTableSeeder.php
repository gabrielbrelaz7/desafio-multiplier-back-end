<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CardapiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create('pt_BR');

        for ($i=1; $i <= 50; $i++) {

            DB::table('cardapios')->insert([
                'nome' => $faker->word
            ]);
        }
    }
}
