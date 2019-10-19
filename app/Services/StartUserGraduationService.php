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

            $stt = StartUserGraduation::where('idUserGraduation', '=', $data['idUserGraduation'])->first();

            if($stt){
                DB::beginTransaction();

                $start = DB::table('start_user_graduations')
                            ->where('idUserGraduation', $data['idUserGraduation'])
                            ->update(['time' => $data['time']]);

                DB::commit();

                $response = ['status' => 'success', 'data' => $start];
            }else{

                DB::beginTransaction();

                $start = StartUserGraduation::create($data);

                DB::commit();

                $response = ['status' => 'success', 'data' => $start];
            }

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }


}
