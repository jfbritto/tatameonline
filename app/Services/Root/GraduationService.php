<?php

namespace App\Services\Root;

use App\Models\Graduation;
use App\Models\UserGraduation;
use DB;
use Exception;

class GraduationService
{
    public function index($id)
    {
        $response = [];

        try{

            $graduations = DB::table('graduations')
                                ->join('sports', 'sports.id', '=', 'graduations.idSport')
                                ->where('graduations.idAcademy', '=', $id)
                                ->where('graduations.isActive', '=', 1)
                                ->select('graduations.*', 'sports.name as sport_name')
                                ->get();


            $response = ['status' => 'success', 'data' => $graduations];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
    
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $graduation = Graduation::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $graduation];
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

            $users = DB::table('user_graduations')->where('idGraduation', '=', $id)->first();

            if(!$users){
   
                DB::beginTransaction();
                
                DB::table('graduations')
                ->where('id', $id)
                ->update(['isActive' => 0]);
                
                DB::commit();
                
                $response = ['status' => 'success'];
            }else{
                $response = ['status' => 'error', 'data' => "Existem alunos vinculados à essa graduação!"];
            }

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listBySport($idSport, $idAcademy)
    {
        $response = [];

        try{

            $graduations = DB::table('graduations')
                                ->where('graduations.idSport', '=', $idSport)
                                ->where('graduations.idAcademy', '=', $idAcademy)
                                ->select('graduations.*')
                                ->get();


            $response = ['status' => 'success', 'data' => $graduations];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}