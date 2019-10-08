<?php

namespace App\Services;

use App\Models\Presence;
use DB;
use Exception;

class PresenceService
{
    public function index($idUser, $idUserGraduation)
    {
        $response = [];

        try{

            $presences = DB::table('presences')
                                ->join('registrations', 'registrations.id', '=', 'presences.idRegistration')
                                ->join('user_graduations', 'user_graduations.id', '=', 'presences.idUserGraduation')
                                ->join('lessons', 'lessons.id', '=', 'registrations.idLesson')
                                ->where('registrations.idUser', '=', $idUser)
                                ->where('user_graduations.id', '=', $idUserGraduation)
                                ->select('presences.*', 'lessons.weekDay', 'lessons.hour')
                                ->get();

            $response = ['status' => 'success', 'data' => $presences];
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

            $presence = Presence::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $presence];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function openLastPresencesByStudent($idUser)
    {
        $response = [];

        try{

            $presences = DB::table('presences')
                                ->join('registrations', 'registrations.id', '=', 'presences.idRegistration')
                                ->join('user_graduations', 'user_graduations.id', '=', 'presences.idUserGraduation')
                                ->join('lessons', 'lessons.id', '=', 'registrations.idLesson')
                                ->join('sports', 'sports.id', '=', 'lessons.idSport')
                                ->where('registrations.idUser', '=', $idUser)
                                ->where('user_graduations.isActive', '=', 1)
                                ->select('presences.*', 'lessons.weekDay', 'lessons.hour', 'sports.name as name_sport')
                                ->orderBy('presences.checkedHour', 'desc')
                                ->limit(5)
                                ->get();

            $response = ['status' => 'success', 'data' => $presences];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}
