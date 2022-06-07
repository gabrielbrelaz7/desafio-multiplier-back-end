<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = 'pedidos';

    protected $fillable = [
            'id',
            'cliente_id',
            'garcom_id',
            'mesa_id',
            'status',
            'produtos',
            'total',
    ];
        
}
