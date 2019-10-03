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

            DB::beginTransaction();

            $user = User::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $user];
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
}