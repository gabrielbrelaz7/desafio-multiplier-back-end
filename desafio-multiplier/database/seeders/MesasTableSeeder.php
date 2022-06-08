<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class MesasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create('pt_BR');

        for ($i=1; $i <= 10; $i++) {
        
            DB::table('mesas')->insert([
                'mesas' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }
    }
}
