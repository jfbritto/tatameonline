<?php

namespace App\Services\Root;

use App\Models\Graduation;
use DB;
use Exception;

class GraduationService
{
    public function index()
    {
        $response = [];

        try{

            $graduation = DB::table('graduations')
                                ->join('sports', 'sports.id', '=', 'graduations.idSport')
                                ->where('graduations.isActive', '=', 1)
                                ->select('graduations.*', 'sports.name as sport_name')
                                ->get();


            $response = ['status' => 'success', 'data' => $graduation];
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

            $graduation = Graduation::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $graduation];
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

            DB::table('graduations')
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

    public function listBySport($id)
    {
        $response = [];

        try{

            $graduations = DB::table('graduations')
                                ->where('graduations.idSport', '=', $id)
                                ->select('graduations.*')
                                ->get();


            $response = ['status' => 'success', 'data' => $graduations];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}