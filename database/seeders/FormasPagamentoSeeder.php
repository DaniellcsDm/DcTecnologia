<?php

namespace Database\Seeders;

use App\Models\FormaPagamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormasPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formasPagamento = [
            ['nome' => 'À Vista'],
            ['nome' => 'Parcelado'],
        ];
    
        FormaPagamento::insert($formasPagamento);
    }
}
