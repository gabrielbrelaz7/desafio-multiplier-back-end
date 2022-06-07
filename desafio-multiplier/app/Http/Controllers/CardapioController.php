<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Restaurante\Cardapio\CardapioServiceInterface;

class CardapioController extends Controller
{

    private $cardapioService;

    public function __construct(
        CardapioServiceInterface $cardapioService
    ){
        $this->cardapioService = $cardapioService;    
    }
    

    public function cadastrarCardapio(Request $request)
    {

        $dados = Validator::make($request->all(), [
            'nomeCardapio' => 'required|string',  
            'nomeProduto' => 'required|json',
            'descricaoProduto' => 'required|json',
            'precoProduto' => 'required|json'
        ]);
        if($dados->fails()){
            return response()->json($dados->errors()->toJson(), 400);
        }
        else{
            $response = $this->cardapioService->cadastrar($dados);
            return response()->json($response, 201);
        }
    }
}
