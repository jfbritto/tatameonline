<?php

namespace App\Services\Admin;

use App\Models\UserGraduation;
use DB;
use Exception;

class UserGraduationService
{
    public function index($id)
    {
        $response = [];

        try{

            $contracts = DB::table('user_graduations')
                                ->join('graduations', 'graduations.id', '=', 'user_graduations.idGraduation')
                                ->join('sports', 'sports.id', '=', 'graduations.idSport')
                                ->where('idUser', '=', $id)
                                ->select('user_graduations.*', 'sports.name as name_sport', 'graduations.name as name_graduation')
                                ->get();

            $response = ['status' => 'success', 'data' => $contracts];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
    
    public function store(array $data)
    {
        $response = [];

        try{
            
            $resp = DB::table('graduations')
                            ->where('id', '=', $data['idGraduation'])->first();
                            
                            $graduation = DB::table('user_graduations')
                            ->join('graduations', 'graduations.id', '=', 'user_graduations.idGraduation')
                            ->where('graduations.idSport', '=', $resp->idSport)
                            ->where('user_graduations.idUser', '=', $data['idUser'])
                            ->first();
                            
                            if($graduation){
                $response = ['status' => 'error', 'data' => "Já existe uma graduação desse esporte vinculada à esse aluno!"];
            }else{

                
                DB::beginTransaction();
                
                $user_graduation = UserGraduation::create($data);
                
                DB::commit();
                
                $response = ['status' => 'success', 'data' => $user_graduation];
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
            
            DB::table('user_graduations')
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
    
    public function listActivesByUser($id)
    {
        $response = [];
    
        try{
    
            $graduations = DB::table('user_graduations')
                                ->join('graduations', 'graduations.id', '=', 'user_graduations.idGraduation')
                                ->join('sports', 'sports.id', '=', 'graduations.idSport')
                                ->where('user_graduations.idUser', '=', $id)
                                ->where('user_graduations.isActive', '=', 1)
                                ->select('user_graduations.*', 'sports.name as name_sport', 'graduations.name as name_graduation')
                                ->get();
    
            $response = ['status' => 'success', 'data' => $graduations];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }
    
        return $response;
    }
}