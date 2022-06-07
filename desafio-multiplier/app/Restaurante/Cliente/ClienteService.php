<?php

namespace App\Restaurante\Cliente;

use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteService implements ClienteServiceInterface
{  

    public function cadastrar($dados)
    {

        $cliente = Cliente::create(array_merge(
            $dados->validated()
        ));
        return [
            'message' => 'Cliente cadastrado com sucesso',
            'cliente' => $cliente
        ];

    }

}
