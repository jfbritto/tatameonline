<?php

namespace App\Services\Root;

use App\Models\Sport;
use DB;
use Exception;

class SportService
{
    public function index()
    {
        $response = [];

        try{

            $sports = DB::table('sports')->where('isAtivo', '=', 1)->get();

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

    public function destroy($id)
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
}