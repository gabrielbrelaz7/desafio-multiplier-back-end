<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pt_BR');

        for ($i=1; $i <= 10000; $i++) {

            DB::table('clientes')->insert([
                'nome' => $faker->firstName,
                'sobrenome' => $faker->lastName,
                'email' => $faker->email,
                'celular' => $faker->phoneNumber,
            ]);
        }
    }
}
