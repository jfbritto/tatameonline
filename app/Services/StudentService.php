<?php

namespace App\Services;

use App\Models\User;
use DB;
use Exception;

class StudentService
{
    public function index($id)
    {
        $response = [];

        try{

            $users = DB::table('users')
                            ->where('idAcademy', '=', $id)
                            ->where('isActive', '=', 1)
                            ->where('isStudent', '=', 1)
                            ->select('users.*', 
                            (DB::raw("(SELECT count(*) FROM registrations WHERE idUser = users.id and isActive=1) AS aulas")))
                            ->get();

            $response = ['status' => 'success', 'data' => $users];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function store(array $data)
    {
        $response = [];

        try{

            $usuario = DB::table('users')->where('email', '=', $data['email'])->where('isActive', '=', 0)->count();

            if($usuario == 0){

                $usuario = DB::table('users')->where('email', '=', $data['email'])->where('isActive', '=', 1)->count();
                
                if($usuario == 0){
                    DB::beginTransaction();
                    
                    $user = User::create($data);
                    
                    DB::commit();
                    
                    $response = ['status' => 'success', 'data' => $user];
                }else{
                    $response = ['status' => 'error', 'data' => 'Email já utilizado por um usuário ativo!'];
                }
            }else{
                $response = ['status' => 'error', 'data' => 'Email já utilizado por um usuário inativo!'];
            }

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function destroy($id)
    {
        $response = [];

        try{

            $aulas = DB::table('registrations')->where('idUser', '=', $id)->where('isActive', '=', 1)->count();

            if($aulas == 0){

                DB::beginTransaction();
                
                DB::table('users')
                        ->where('id', $id)
                        ->update(['isActive' => 0]);
                
                DB::commit();
                
                $response = ['status' => 'success'];
            }else{
                $response = ['status' => 'error', 'data' => 'Existem aulas vinculadas a este aluno!'];
            }

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}