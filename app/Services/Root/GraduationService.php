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

            $graduation = DB::table('graduations')->where('isActive', '=', 1)->get();

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
}