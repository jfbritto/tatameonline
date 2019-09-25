<?php

namespace App\Services\Admin;

use App\Models\Registration;
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

            DB::beginTransaction();

            $registration = Registration::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $registration];
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