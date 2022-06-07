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
        ]);
        if($dados->fails()){
            return response()->json($dados->errors()->toJson(), 400);
        }
        else{
            $response = $this->mesaService->cadastrar($dados);
            return response()->json($response, 201);
        }
    }
}
