<?php

namespace App\Services;

use App\Models\User;
use DB;
use Exception;

class UserService
{
    public function index($id)
    {
        $response = [];

        try{

            $users = DB::table('users')
                                ->where('idAcademy', '=', $id)
                                ->where('isActive', '=', 1)
                                ->where('isAdmin', '=', 1)
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

            $users = DB::table('users')->where('email', '=', $data['email'])->where('idAcademy', '=', $data['idAcademy'])->first();

            if(!$users){

                DB::beginTransaction();

                $user = User::create($data);

                DB::commit();

                $response = ['status' => 'success', 'data' => $user];

            }else{
                $response = ['status' => 'error', 'data' => 'Já existe um usuário cadastrado com esse email nessa academia!'];
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
            DB::beginTransaction();

            DB::table('users')
                ->where('id', $id)
                ->update(['isActive' => 0]);

            DB::commit();

            $response = ['status' => 'success'];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function updateAvatar(Array $request)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $nameFile = null;
            if ( $request->hasfile('avatar') && $request->file('avatar')->isValid() ) {
                $nameFile = Laracrop::cropImage($request->input('avatar'));
                Image::make(public_path("filetmp/{$nameFile}"))->resize(200, 200)->save(storage_path("app/public/users/{$nameFile}"));
                // File::move(public_path("filetmp/{$nameFile}"), storage_path("app/public/churches/{$nameFile}"));
            }

            DB::commit();

            $response = ['status' => 'success'];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
