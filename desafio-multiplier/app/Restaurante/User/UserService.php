<?php

namespace App\Restaurante\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{  

    public function cadastrar($dados)
    {   

        try {
            $usuario = User::create(array_merge(
                $dados->validated(),
                ['password' => bcrypt($dados->validated()['password'])]
            ));
    
            return [
                'mensagem' => 'Usuário cadastrado com sucesso',
                'usuário' => $usuario
            ];
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }


    public function listar()
    {   

        try {
            $users = User::all();

            if ($users) {
                return ['usuários' => $users];
            }
            else {
                return response()->json("Nenhum usuário cadastrado", 401);
            }
    
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }


    public function atualizar($id, $dados)
    {   

        try {
            $usuario = User::findOrFail($id) -> update([
                'name' => $dados->validated()['name'],
                'email' => $dados->validated()['email'],
                'password' => bcrypt($dados->validated()['password'])
                ]
            );
    
            return [
                'mensagem' => 'Usuário atualizado com sucesso',
            ];
    
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }


    public function deletar($dados)
    {   

        try {
            User::where('id', $dados->validated()['id'])->delete();

            return [
                'mensagem' => 'Usuário deletado cadastrado com sucesso',
                'User' => $User
            ];
    
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

    }


}