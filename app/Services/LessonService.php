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

            $hora_ini = date("H:i:s", strtotime("-10 minutes"));
            $hora_fim = date("H:i:s", strtotime("+10 minutes"));

            $lesson = DB::select( DB::raw("select
                                                le.*,
                                                sp.id as sport_id,
                                                sp.name as sport_name,
                                                re.id as registration_id,
                                                ug.id as user_graduation_id

                                            from
                                                lessons le
                                                join registrations re on re.idLesson=le.id
                                                join users us on re.idUser=us.id
                                                join sports sp on le.idSport=sp.id
                                                join user_graduations ug on ug.idUser=us.id
                                                join graduations gr on gr.id=ug.idGraduation
                                                left join presences pr on pr.idRegistration=re.id
                                            where
                                                re.idUser='$id'
                                                and le.weekDay=".date("N")."
                                                and pr.id is null
                                                and gr.idSport=sp.id

                                                and le.isActive = 1
                                                and re.isActive = 1
                                                and gr.isActive = 1
                                                and ug.isActive = 1

                                                and le.hour >= '$hora_ini'
                                                and le.hour <= '$hora_fim'
                                            order by
                                                le.hour"));


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
                            // ->where('les.hour', '<=', now())
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

    public function lessonAlunsList($id)
    {
        $response = [];

        try{

            $lessons = DB::table('lessons')
                            ->join('registrations', 'registrations.idLesson', '=', 'lessons.id')
                            ->join('users', 'users.id', '=', 'registrations.idUser')
                            ->where('lessons.weekDay', '=', date("N"))
                            ->where('lessons.id', '=', $id)
                            ->select('lessons.*', 'users.name as student_name', 'registrations.id as id_registration',
                            (DB::raw("(select CASE WHEN id is null THEN 'false' ELSE 'true' END from presences where idRegistration = registrations.id and date_format(checkedHour, '%Y-%m-%d') = '".date("Y-m-d")."') as present")),
                            (DB::raw("(select
                                            ugr.id
                                        from
                                            user_graduations ugr
                                            join graduations gra on ugr.idGraduation=gra.id
                                        where
                                            ugr.isActive=1
                                            and ugr.idUser=users.id
                                            and gra.idSport=lessons.idSport) as id_user_graduation")) )
                            ->orderByRaw('users.name')
                            ->get();

            $response = ['status' => 'success', 'data' => $lessons];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }


}
