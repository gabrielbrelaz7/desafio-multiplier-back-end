<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
