<?php

namespace App\Services\Root;

use App\Models\Academy;
use DB;
use Exception;

class AcademyService
{
    public function index()
    {
        $response = [];

        try{

            $academies = DB::table('academies')->where('isActive', '=', 1)->get();

            $response = ['status' => 'success', 'data' => $academies];
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
            
            $academy = Academy::create($data);
            
            DB::commit();
            
            $response = ['status' => 'success', 'data' => $academy];
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
            
            DB::table('academies')
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
    
    public function checkToken($idAcademy, $token)
    {
        $response = [];
    
        try{
    
            $resp = DB::table('academies')
                                ->where('id', '=', $idAcademy)
                                ->where('token', '=', $token)
                                ->first();
    
            if($resp)
                $check = true;
            else    
                $check = false;

            $response = ['status' => 'success', 'data' => $check];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }
    
        return $response;
    }
}