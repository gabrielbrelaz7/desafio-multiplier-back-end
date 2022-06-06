<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'type' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        return response()->json([
            'mensagem' => 'Usuário cadastrado com sucesso',
            'usuário' => $user
        ], 201);
    }


    public function get()
    {

        $users = User::all();

        if ($users) {
            return response()->json([$users], 200);
        }
        else {
            return response()->json("Nenhum usuário cadastrado", 401);
        }

    }


    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id) -> update([
            'name' => $request ->name,
            'email' => $request ->email,
            'password' => bcrypt($request->password)
            ]
        );

        return response()->json([
            'mensagem' => 'Usuário atualizado com sucesso',
            'usuário' => $user
        ], 201);

    }

}
