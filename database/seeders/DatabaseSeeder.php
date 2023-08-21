<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Produto;

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
        $this->call([
            ClientesSeeder::class, // Adicione a seeder que você criou
            // Outras seeders
        ]);
        $this->call([
            FormasPagamentoSeeder::class,
            
        ]);
    }
}
