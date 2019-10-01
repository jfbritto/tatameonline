<?php

namespace App\Services\Admin;

use App\Models\Registration;
use App\Models\UserGraduation;
use App\Models\Lesson;
use DB;
use Exception;

class RegistrationService
{
    public function index($id)
    {
        $response = [];

        try{

            $registrations = DB::table('registrations')
                                ->join('lessons', 'lessons.id', '=', 'registrations.idLesson')
                                ->join('users', 'users.id', '=', 'registrations.idUser')
                                ->where('lessons.id', '=', $id)
                                ->where('registrations.isActive', '=', 1)
                                ->select('registrations.*', 'users.name as name_alun')
                                ->get();

            $response = ['status' => 'success', 'data' => $registrations];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function store(array $data)
    {
        $response = [];

        try{

            $contract = DB::table('contracts')
                                ->where('idUser', '=', $data['idUser'])
                                ->where('isActive', '=', 1)
                                ->first();
            
            if($user_graduation){

                
                $lesson = Lesson::find($data['idLesson']);
                
                $user_graduation = DB::table('user_graduations')
                                            ->join('graduations', 'graduations.id', '=', 'user_graduations.idGraduation')
                                            ->where('user_graduations.idUser', '=', $data['idUser'])
                                            ->where('user_graduations.isActive', '=', 1)
                                            ->where('graduations.idSport', '=', $lesson->idSport)
                                            ->first();
                                
                if($user_graduation){

                    DB::beginTransaction();

                    $registration = Registration::create($data);
                    
                    DB::commit();
                    
                    $response = ['status' => 'success', 'data' => $registration];
                }else{
                    
                    $response = ['status' => 'error', 'data' => "Aluno sem graduação desse esporte cadastrada."];
                }   
            }else{
                $response = ['status' => 'error', 'data' => "Aluno sem contrato cadastrado."];
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

            DB::table('registrations')
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
}