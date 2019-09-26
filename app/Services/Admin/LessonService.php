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
                                ->select('lessons.*', 'sports.name as sport_name',
                                (DB::raw("(SELECT count(*) FROM registrations WHERE idLesson = lessons.id and isActive=1) AS alunos")))
                                ->orderByRaw('lessons.weekDay')
                                ->orderByRaw('lessons.hour')
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

            $alunos = DB::table('registrations')->where('idLesson', '=', $id)->where('isActive', '=', 1)->count();

            if($alunos == 0){
    
                DB::beginTransaction();
                
                DB::table('lessons')
                ->where('id', $id)
                ->update(['isActive' => 0]);
                
                DB::commit();
                
                $response = ['status' => 'success'];
            }else{
                $response = ['status' => 'error', 'data' => 'Existem alunos matriculados nesta aula!'];
            }

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }



    public function listNotAluns($idLesson, $idAcademy)
    {
        $response = [];

        try{

            $users = DB::table('registrations')
                                ->join('lessons', 'lessons.id', '=', 'registrations.idLesson')
                                ->join('users', 'users.id', '=', 'registrations.idUser')
                                ->where('lessons.id', '=', $idLesson)
                                ->where('registrations.isActive', '=', 1)
                                ->select('users.*')
                                ->get();

            $data = [];
            foreach ($users as $user) {
                $data[] = $user->id;
            }

            $us = DB::table('users')->where('idAcademy', '=', $idAcademy)->where('isActive', '=', 1)->where('isStudent', '=', 1)->whereNotIn('id', $data)->get();

            $response = ['status' => 'success', 'data' => $us];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
    
    public function listAluns($idUser)
    {
        $response = [];

        try{

            $lessons = DB::table('lessons')
                                ->join('registrations', 'registrations.idLesson', '=', 'lessons.id')
                                ->join('sports', 'sports.id', '=', 'lessons.idSport')
                                ->where('registrations.idUser', '=', $idUser)
                                ->where('registrations.isActive', '=', 1)
                                ->select('lessons.*', 'sports.name as sport_name', 'registrations.id as id_registration')
                                ->get();                    

            $response = ['status' => 'success', 'data' => $lessons];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}