<?php

namespace App\Services;

use App\Models\Bug;
use DB;
use Exception;

class BugService
{
    public function index()
    {
        $response = [];

        try{

            $bugs = DB::table('bugs')->get();

            $response = ['status' => 'success', 'data' => $bugs];
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

            $bug = Bug::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $bug];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function setRead($id)
    {
        $response = [];

        try{
            DB::beginTransaction();

            DB::table('bugs')
                ->where('id', $id)
                ->update(['isRead' => 1]);

            DB::commit();

            $response = ['status' => 'success'];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
