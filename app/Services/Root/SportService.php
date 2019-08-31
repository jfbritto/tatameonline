<?php

namespace App\Services\Root;

use App\Models\Sport;
use DB;
use Exception;

class SportService
{
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
}