<?php

namespace App\Restaurante\Cardapio;

use App\Models\Cardapio;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class CardapioService implements CardapioServiceInterface
{  

    public function cadastrar($dados)
    {

        $cardapio = new Cardapio;
        $cardapio->nome = $dados->validated()['nomeCardapio'];
        $cardapio->save();

        $itensProdutos = [
            json_decode($dados->validated()['nomeProduto']),
            json_decode($dados->validated()['descricaoProduto']),
            json_decode($dados->validated()['precoProduto'])
        ];

        $produtos = $this->cadastrarItens($itensProdutos, $cardapio->id);

        if($produtos && $cardapio) {
            return [
                'mensagem' => 'Cardapio cadastrado com sucesso',
                'cardapio' => $cardapio,
                'produtos' => $produtos
            ];
        }

    }


    public function cadastrarItens($itensProdutos, $cardapioID)
    {

        $produtos = [];

        for ($i=0; $i < count($itensProdutos[0]->produtos); $i++) {
            $produto = new Produto;
            $produto->cardapio_id = $cardapioID;
            $produto->nome = $itensProdutos[0]->produtos[$i];
            $produto->descricao = $itensProdutos[1]->descricoes[$i];
            $produto->preco = $itensProdutos[2]->precos[$i];
            $produto->save();

            array_push($produtos, $produto);
        }

        return $produtos;
        
    }

}
