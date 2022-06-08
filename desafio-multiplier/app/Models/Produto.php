<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    protected $table = 'produtos';

    protected $fillable = [
        'id', 
        'cardapio_id',
        'nome',
        'descricao',
        'preco',
    ];
        
}