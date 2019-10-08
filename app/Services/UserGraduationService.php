<?php

namespace App\Services;

use App\Models\UserGraduation;
use DB;
use Exception;

class UserGraduationService
{
    public function index($id)
    {
        $response = [];

        try{

            $graduations = DB::table('user_graduations as user_g')
                                ->join('graduations as gra', 'gra.id', '=', 'user_g.idGraduation')
                                ->join('sports as spo', 'spo.id', '=', 'gra.idSport')
                                ->where('user_g.idUser', '=', $id)
                                ->select('user_g.*', 'spo.name as name_sport', 'gra.name as name_graduation', 'gra.hours as required_hours',
                                (DB::raw("(select
                                                sum(le.timeLesson)
                                            from
                                                presences pr
                                                join registrations re on pr.idRegistration=re.id
                                                join user_graduations ug on pr.idUserGraduation=ug.id
                                                join graduations gr on ug.idGraduation=gr.id
                                                join lessons le on re.idLesson=le.id
                                            where
                                                ug.id= user_g.id
                                                and ug.idUser = ".$id.") as completed_hours")))
                                ->get();

            $response = ['status' => 'success', 'data' => $graduations];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function store(array $data)
    {
        $response = [];

        try{

            $resp = DB::table('graduations')
                            ->where('id', '=', $data['idGraduation'])->first();

                            $graduation = DB::table('user_graduations')
                            ->join('graduations', 'graduations.id', '=', 'user_graduations.idGraduation')
                            ->where('graduations.idSport', '=', $resp->idSport)
                            ->where('user_graduations.idUser', '=', $data['idUser'])
                            ->first();

                            if($graduation){
                $response = ['status' => 'error', 'data' => "Já existe uma graduação desse esporte vinculada à esse aluno!"];
            }else{


                DB::beginTransaction();

                $user_graduation = UserGraduation::create($data);

                DB::commit();

                $response = ['status' => 'success', 'data' => $user_graduation];
            }
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

            DB::table('user_graduations')
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

    public function listActivesByUser($id)
    {
        $response = [];

        try{

            $graduations = DB::table('user_graduations as user_g')
                                ->join('graduations as gra', 'gra.id', '=', 'user_g.idGraduation')
                                ->join('sports as spo', 'spo.id', '=', 'gra.idSport')
                                ->where('user_g.idUser', '=', $id)
                                ->where('user_g.isActive', '=', 1)
                                ->select('user_g.*', 'spo.name as name_sport', 'gra.name as name_graduation', 'gra.hours as required_hours',
                                (DB::raw("(select
                                                sum(le.timeLesson)
                                            from
                                                presences pr
                                                join registrations re on pr.idRegistration=re.id
                                                join user_graduations ug on pr.idUserGraduation=ug.id
                                                join graduations gr on ug.idGraduation=gr.id
                                                join lessons le on re.idLesson=le.id
                                            where
                                                ug.id= user_g.id
                                                and ug.idUser = ".$id.") as completed_hours")))
                                ->get();

            $response = ['status' => 'success', 'data' => $graduations];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
