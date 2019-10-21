<?php

namespace App\Services;

use App\Models\User;
use App\Models\Academy;
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

                $pass = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
                $password = bcrypt($pass);
                DB::table('users')->where('id', $user->id)->update(['password' => $password]);
                $academy = Academy::where('id', '=', $user->idAcademy)->first()->name;
                //enviar email
                Mail::to($user->email)->queue(new SendMailUser($user, "1", $pass, $academy));

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

    public function update(array $data)
    {
        $response = [];

        try{

            $user = User::where('id', '=', $data['id'])->first();

            if($user->idAcademy == $data['idAcademy']){

                DB::beginTransaction();

                $user = DB::table('users')
                            ->where('id', $data['id'])
                            ->update(['name' => $data['name'],
                                    'email' => $data['email'],
                                    'phone' => $data['phone'],
                                    'cpf' => $data['cpf'],
                                    'birth' => $data['birth'],
                                    'responsible' => $data['responsible'],
                                    'phoneResponsible' => $data['phoneResponsible'],
                                    'zipCode' => $data['zipCode'],
                                    'city' => $data['city'],
                                    'neighborhood' => $data['neighborhood'],
                                    'address' => $data['address'],
                                    'number' => $data['number'],
                                    'complement' => $data['complement'],
                                    'observation' => $data['observation']]
                            );

                DB::commit();

                $response = ['status' => 'success', 'data' => $user];
            }else{
                $response = ['status' => 'error', 'data' => "Usuário selecionado não pertence à esta academia!"];
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

    public function find($id)
    {
        $response = [];

        try{

            $user = DB::table('users')
            ->where('id', '=', $id)
            ->first();

            $response = ['status' => 'success', 'data' => $user];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function editPass(Array $data)
    {
        $response = [];

        try{

            $user = User::where('id', '=', $data['id'])->first();

            if($user->idAcademy == $data['idAcademy']){

                DB::beginTransaction();

                $pass = bcrypt($data['pass']);

                DB::table('users')
                        ->where('id', $data['id'])
                        ->update(['password' => $pass]);

                DB::commit();

                $response = ['status' => 'success'];

            }else{
                $response = ['status' => 'error', 'data' => "Usuário selecionado não pertence à esta academia!"];
            }

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function editAvatar(Array $data)
    {
        $response = [];

        try{

            $user = User::where('id', '=', $data['id'])->first();

            if($user->idAcademy == $data['idAcademy']){

                DB::beginTransaction();

                DB::table('users')
                        ->where('id', $data['id'])
                        ->update(['avatar' => $data['avatar']]);

                DB::commit();

                $response = ['status' => 'success'];

            }else{
                $response = ['status' => 'error', 'data' => "Usuário selecionado não pertence à esta academia!"];
            }

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
