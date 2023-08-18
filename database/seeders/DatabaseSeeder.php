<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Outros seeders
        Produto::create([
            'nome' => 'Produto 1',
            'descricao' => 'Descrição do Produto 1',
            'preco' => 10.99,
        ]);
    
        Produto::create([
            'nome' => 'Produto 2',
            'descricao' => 'Descrição do Produto 2',
            'preco' => 20.99,
        ]);
        
        // ... outros produtos
    }
    
}
