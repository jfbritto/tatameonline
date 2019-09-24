<?php

namespace App\Services\Admin;

use App\Models\Lesson;
use DB;
use Exception;

class LessonService
{
    public function index($id)
    {
        $response = [];

        try{

            $lessons = DB::table('lessons')
                                ->join('sports', 'sports.id', '=', 'lessons.idSport')
                                ->where('lessons.idAcademy', '=', $id)
                                ->where('lessons.isActive', '=', 1)
                                ->select('lessons.*', 'sports.name as sport_name')
                                ->get();

            $response = ['status' => 'success', 'data' => $lessons];
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

            $lesson = Lesson::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $lesson];
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

            DB::table('lessons')
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