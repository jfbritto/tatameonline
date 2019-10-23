<?php

namespace App\Services;

use App\Models\Historic;
use DB;
use Exception;

class HistoricService
{
    // public function index()
    // {
    //     $response = [];

    //     try{

    //         $historics = DB::table('historics')->where('isActive', '=', 1)->get();

    //         $response = ['status' => 'success', 'data' => $historics];
    //     }catch(Exception $e){
    //         $response = ['status' => 'error', 'data' => $e->getMessage()];
    //     }

    //     return $response;
    // }

    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $historic = Historic::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $historic];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}
