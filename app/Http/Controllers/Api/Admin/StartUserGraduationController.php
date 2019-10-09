<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StartUserGraduationService;

class StartUserGraduationController extends Controller
{
    private $startUserGraduationService;

    public function __construct(StartUserGraduationService $startUserGraduationService)
    {
        $this->startUserGraduationService = $startUserGraduationService;
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
