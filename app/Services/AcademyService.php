<?php

namespace App\Services;

use App\Models\Academy;
use DB;
use Illuminate\Support\Facades\Hash;
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
    
    public function checkuserpass($idUser, $password)
    {
        $response = [];
        
        try{
    
            $user = DB::table('users')
                                ->select('password')    
                                ->where('id', '=', $idUser)
                                ->first();
            

            if(Hash::check($password, $user->password)){
                $check = true;
            }else{
                $check = false;
            }

            $response = ['status' => 'success', 'data' => $check];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }
    
        return $response;
    }

    public function getById($id)
    {
        $response = [];
        $date = date('Y-m');

        try{

            $academy = DB::table('academies')
                                ->where('id', '=', $id)
                                ->select('academies.*', 
                                (DB::raw("(SELECT count(*) FROM users WHERE idAcademy = academies.id and isActive=1 and isStudent=1) AS aluns")),
                                (DB::raw("(SELECT count(*) FROM lessons WHERE idAcademy = academies.id and isActive=1) AS lessons")),
                                (DB::raw("(select
                                                sum(inv.value) as total
                                            from
                                                invoices inv
                                                join users us on inv.idUser=us.id
                                            where
                                                us.idAcademy = ".$id."
                                                and us.isStudent = 1
                                                and us.isActive = 1
                                                and inv.isPaid = 1
                                                and date_format(inv.paymentDate, '%Y-%m') = '".$date."') AS financial")) 
                                )->first();

            $response = ['status' => 'success', 'data' => $academy];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function updateToken($id)
    {
        $response = [];
        
        try{
            DB::beginTransaction();

            $token = rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);
            
            DB::table('academies')
                            ->where('id', $id)
                            ->update(['token' => $token]);
            
            DB::commit();
            
            $response = ['status' => 'success', 'data' => $token];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }
        
        return $response;
    }

    public function updateAlunSetPresence($id, $status)
    {
        $response = [];
        
        try{
            DB::beginTransaction();
            
            DB::table('academies')
                            ->where('id', $id)
                            ->update(['alunSetPresence' => $status]);
            
            DB::commit();
            
            $response = ['status' => 'success', 'data' => ''];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }
        
        return $response;
    }
}