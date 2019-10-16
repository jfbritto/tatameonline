<?php

namespace App\Services;

use App\Models\User;
use DB;
use Exception;
use App\Mail\SendMailUser;
use Illuminate\Support\Facades\Mail;

class StudentService
{
    public function index($id)
    {
        $response = [];

        try{

            $users = DB::table('users')
                            ->where('idAcademy', '=', $id)
                            ->where('isStudent', '=', 1)
                            ->select('users.*',
                            (DB::raw("(SELECT count(*) FROM registrations WHERE idUser = users.id and isActive=1) AS aulas")))
                            ->orderBy('users.name')
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

            $usuario = DB::table('users')->where('email', '=', $data['email'])->where('idAcademy', '=', $data['idAcademy'])->count();

            if($usuario == 0){

                DB::beginTransaction();

                $user = User::create($data);

                Mail::to($user->email)->queue(new SendMailUser($user));

                DB::commit();

                $response = ['status' => 'success', 'data' => $user];

            }else{
                $response = ['status' => 'error', 'data' => 'Email já utilizado por um usuário desta academia!'];
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

    public function activate($id)
    {
        $response = [];

        try{

            DB::beginTransaction();

            DB::table('users')
                    ->where('id', $id)
                    ->update(['isActive' => 1]);

            DB::commit();

            $response = ['status' => 'success'];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
