<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clientes = [
            [
                'nome' => 'Cliente 1',
                'email' => 'cliente1@example.com',
                'telefone' => '123456789',
            ],
            [
                'nome' => 'Cliente 2',
                'email' => 'cliente2@example.com',
                'telefone' => '987654321',
            ],
            // Adicione mais clientes conforme necessário
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}


