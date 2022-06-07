<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{

    protected $table = 'cardapios';

    protected $fillable = [
        'id', 
        'nome'
    ];
        
}
