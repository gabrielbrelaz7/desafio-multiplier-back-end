<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;


class PedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create('pt_BR');

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
                'cliente_id' => $faker->numberBetween(1, 10000),
                'garcom_id' => $faker->numberBetween(1, 5),
                'mesa_id' => $faker->numberBetween(1, 10),
                'status' => $faker->randomElement(['para fazer', 'em andamento']),
                'produtos' => json_encode($faker->words(3)),
                'total' => $faker->randomNumber(2, true),
                'created_at' => $faker->date('Y-m-d H:i:s'),
                'updated_at' => now()
            ]);
        }

        for ($i=1; $i <= 399950; $i++) {

            DB::table('pedidos')->insert([
                'cliente_id' => $faker->numberBetween(1, 10000),
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
