<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Restaurante\Mesa\MesaServiceInterface;

class MesaController extends Controller
{

    private $mesaService;

    public function __construct(
        MesaServiceInterface $mesaService
    ){
        $this->mesaService = $mesaService;    
    }
    

    public function cadastrarMesa(Request $request)
    {

        $dados = Validator::make($request->all(), [
            'mesas' => 'required|integer',  
            'requester' => 'required|string'
        ]);
        if($dados->fails()){
            return response()->json($dados->errors()->toJson(), 400);
        }
        else if($request->requester !== 'gerente'){
            return response()->json("Usuário não tem privilégios para realizer esta ação.", 401);
        }
        else{
            $response = $this->mesaService->cadastrar($dados);
            return response()->json($response, 201);
        }
    }
}
