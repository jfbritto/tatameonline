<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StartUserGraduationService;
use App\Services\UserGraduationService;

class StartUserGraduationController extends Controller
{
    private $startUserGraduationService;
    private $userGraduationService;

    public function __construct(StartUserGraduationService $startUserGraduationService, UserGraduationService $userGraduationService)
    {
        $this->startUserGraduationService = $startUserGraduationService;
        $this->userGraduationService = $userGraduationService;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dataValid = $request->validate([
            'time' => 'required',
            'idUserGraduationStart' => 'required',
            ]);

        $data = [
            'time' => $request->time,
            'idUserGraduation' => $request->idUserGraduationStart,
        ];

        $response = $this->startUserGraduationService->store($data);

        if($request->startDate != null){
            if($response['status'] == 'success'){
                $data2 = ['startDate'=>$request->startDate, 'idUserGraduation'=>$response['data']];
                $this->userGraduationService->updateStartDate($data2);
            }
        }

        if($response['status'] == 'success')
        return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $response = $this->startUserGraduationService->destroy($id);

        if($response['status'] == 'success')
        return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

}
