<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(MesasTableSeeder::class);
        $this->call(CardapiosTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(ProdutosTableSeeder::class);
        $this->call(PedidosTableSeeder::class);
        $this->call(TestesTableSeeder::class);
    }
}
