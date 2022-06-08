<?php

namespace App\Restaurante\Mesa;

use App\Models\Mesa;
use Illuminate\Support\Facades\DB;

class MesaService implements MesaServiceInterface
{  

    public function cadastrar($dados)
    {

        try {
            $mesa = Mesa::create(array_merge(
                $dados->validated()
            ));
            
            return [
                'mensagem' => 'Mesa cadastrada com sucesso',
                'Mesa' => $mesa
            ];
            
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }

}
