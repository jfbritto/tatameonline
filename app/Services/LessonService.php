<?php

namespace App\Services;

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
            ->orderByRaw('lessons.weekDay')
                                ->orderByRaw('lessons.hour')
                                ->select('lessons.*', 'sports.name as sport_name', 'registrations.id as id_registration')
                                ->get();                    

                                $response = ['status' => 'success', 'data' => $lessons];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
    
    public function listLessonsByUser($id)
    {
        $response = [];
        
        try{
            
            $lessons = DB::table('lessons')
                                ->join('registrations', 'registrations.idLesson', '=', 'lessons.id')
                                ->join('sports', 'sports.id', '=', 'lessons.idSport')
                                ->where('registrations.idUser', '=', $id)
                                ->where('lessons.isActive', '=', 1)
                                ->where('registrations.isActive', '=', 1)
                                ->orderByRaw('lessons.weekDay')
                                ->orderByRaw('lessons.hour')
                                ->select('lessons.*', 'sports.name as sport_name')
                                ->get();
                                
            $response = ['status' => 'success', 'data' => $lessons];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }
        
        return $response;
    }
    
    public function nextLesson($id)
    {
        $response = [];
        
        try{

            $i = 1;
            $less = false;
            
            $lesson = DB::table('lessons')
            ->join('registrations', 'registrations.idLesson', '=', 'lessons.id')
            ->join('sports', 'sports.id', '=', 'lessons.idSport')
                        ->where('registrations.idUser', '=', $id)
                        ->where('registrations.isActive', '=', 1)
                        ->where('lessons.isActive', '=', 1)
                        ->where('lessons.weekDay', '=', date("N"))
                        ->where('lessons.hour', '>', date("H:i:s"))
                        ->select('lessons.*', 'sports.name as sport_name')
                        ->orderByRaw('lessons.hour')
                        ->first();

            if(!$lesson){
                
                while ($less == false && $i < 7) {
                
                    $lesson = DB::table('lessons')
                        ->join('registrations', 'registrations.idLesson', '=', 'lessons.id')
                        ->join('sports', 'sports.id', '=', 'lessons.idSport')
                        ->where('registrations.idUser', '=', $id)
                        ->where('registrations.isActive', '=', 1)
                        ->where('lessons.isActive', '=', 1)
                        ->where('lessons.weekDay', '=', date("N", strtotime("+".$i." day")))
                        ->select('lessons.*', 'sports.name as sport_name')
                        ->orderByRaw('lessons.hour')
                        ->first();
                        
                    if($lesson){
                        $less = true;
                    }
                    
                    $i++;
                }
                
                if(!$lesson){
                    $lesson = DB::table('lessons')
                    ->join('registrations', 'registrations.idLesson', '=', 'lessons.id')
                    ->join('sports', 'sports.id', '=', 'lessons.idSport')
                    ->where('registrations.idUser', '=', $id)
                    ->where('registrations.isActive', '=', 1)
                    ->where('lessons.isActive', '=', 1)
                    ->where('lessons.weekDay', '=', date("N"))
                    ->where('lessons.hour', '<', date("H:i:s"))
                    ->select('lessons.*', 'sports.name as sport_name')
                    ->orderByRaw('lessons.hour')
                    ->first();
                }
            }
            
            $response = ['status' => 'success', 'data' => $lesson];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
    
    public function checkLesson($id)
    {
        $response = [];
        
        try{
            
            $lesson = DB::table('lessons')
                    ->join('registrations', 'registrations.idLesson', '=', 'lessons.id')
                    ->join('user_graduations', 'user_graduations.idUser', '=', 'registrations.idUser')
                    ->join('graduations', 'graduations.id', '=', 'user_graduations.idGraduation')
                    ->join('sports', 'sports.id', '=', 'lessons.idSport')
                    ->where('registrations.idUser', '=', $id)
                    ->where('registrations.isActive', '=', 1)
                    ->where('lessons.isActive', '=', 1)
                    ->where('user_graduations.isActive', '=', 1)
                    ->where('lessons.weekDay', '=', date("N"))
                    ->where('lessons.hour', '>=', date("H:i:s", strtotime("-10 minutes")))
                    ->where('lessons.hour', '<=', date("H:i:s", strtotime("+10 minutes")))
                    ->select('lessons.*', 'sports.name as sport_name', 'registrations.id as registration_id', 'user_graduations.id as user_graduation_id')
                    ->first();
                    
                    $presence = false;        
                    if($lesson){

                        $presence = DB::table('presences')
                        ->where('idRegistration', '=', $lesson->registration_id)
                        ->where('idUserGraduation', '=', $lesson->user_graduation_id)
                        ->where('checkedHour', '>=', date("Y-m-d H:i:s", strtotime("-10 minutes")))
                    ->where('checkedHour', '<=', date("Y-m-d H:i:s", strtotime("+10 minutes")))
                    ->first();
            }
            
            if($presence)
            $lesson = null;

            $response = ['status' => 'success', 'data' => $lesson];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
    
    public function lessonNow($id)
    {
        $response = [];
        
        try{
            
            $lessons = DB::table('lessons as les')
                            ->join('sports', 'sports.id', '=', 'les.idSport')
                            ->where('les.isActive', '=', 1)
                            ->where('les.idAcademy', '=', $id)
                            ->where('les.hour', '<=', now())
                            ->where('les.weekDay', '=', date("N"))
                            ->select('les.*', 'sports.name as sport_name',
                                (DB::raw("(select 
                                                count(*) 
                                            from
                                                presences
                                                join registrations on presences.idRegistration=registrations.id
                                                join lessons ls on registrations.idLesson=ls.id
                                            where
                                                ls.id = les.id and 
                                                date_format(presences.checkedHour, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d')) AS presences")
                                )
                            )
                            ->get();

            $response = ['status' => 'success', 'data' => $lessons];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
    

}