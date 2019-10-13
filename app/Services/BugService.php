<?php

namespace App\Services;

use App\Models\Sport;
use DB;
use Exception;

class BugService
{
    public function index()
    {
        $response = [];

        try{

            $sports = DB::table('bugs')->get();

            $response = ['status' => 'success', 'data' => $sports];
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

            $sport = Sport::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $sport];
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
