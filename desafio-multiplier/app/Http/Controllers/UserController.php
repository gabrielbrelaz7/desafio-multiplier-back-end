<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Restaurante\User\UserServiceInterface;
use App\Models\User;
use Validator;

class UserController extends Controller
{

    private $userService;

    public function __construct(
        UserServiceInterface $userService
    ){
        $this->userService = $userService;    
    }
    

    public function cadastrarUsuario(Request $request) 
    {

        $dados = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'type' => 'required|string',
            'requester' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($dados->fails()){
            return response()->json($dados->errors()->toJson(), 400);
        }
        else if($request->requester !== 'gerente'){
            return response()->json("Usuário não tem privilégios para realizer esta ação.", 401);
        }
        else if($request->type !== 'gerente' && $request->type !== 'garcom' && $request->type !== 'cozinheiro'){
            return response()->json("O usuário deve ser gerente, garçom ou cozinheiro.", 401);
        }
        else{
            $response = $this->userService->cadastrar($dados);
            return response()->json($response, 201);
        }
    }


    public function listarUsuarios()
    {
        $response = $this->userService->listar();
        return response()->json($response, 201);
    }


    public function atualizarUsuario(Request $request, $id)
    {
            $dados = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'requester' => 'required|string',
                'password' => 'required|string|min:6',
            ]);

            if($dados->fails()){
                return response()->json($dados->errors()->toJson(), 400);
            }
            else if($request->requester !== 'gerente'){
                return response()->json("Usuário não tem privilégios para realizar esta ação.", 401);
            }
            else {
                $response = $this->userService->atualizar($id, $dados);
                return response()->json($response, 200);
            }
    }



    public function deletarUsuario(Request $request)
    {
            $dados = Validator::make($request->all(), [
                'id' => 'required|integer',
                'requester' => 'required|string',
            ]);

            if($dados->fails()){
                return response()->json($dados->errors()->toJson(), 400);
            }
            else if($request->requester !== 'gerente'){
                return response()->json("Usuário não tem privilégios para realizer esta ação.", 401);
            }
            else {
                $response = $this->userService->deletar($dados);
                return response()->json($response, 201);
            }
    }



}
