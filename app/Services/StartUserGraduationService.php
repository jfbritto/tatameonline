<?php

namespace App\Services;

use App\Models\StartUserGraduation;
use DB;
use Exception;

class StartUserGraduationService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $sport = StartUserGraduation::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $sport];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }


}
