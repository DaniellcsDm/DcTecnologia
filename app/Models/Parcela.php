<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    protected $fillable = ['vencimento', 'valor'];

    // Relação com a venda
    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
