<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GraduationService;
use App\Models\Graduation;
use App\Models\Sport;
use App\Models\Academy;

class GraduationController extends Controller
{
    private $graduationService;

    public function __construct(GraduationService $graduationService)
    {
        $this->graduationService = $graduationService;
    }

    public function index(Academy $academy)
    {
        $response = $this->graduationService->index($academy->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dataValid = $request->validate([
            'name' => 'required',
            'hours' => 'required',
            'idAcademy' => 'required',
            'idSport' => 'required',
            'startDate' => 'required',
            'color' => 'required'
        ]);

        $response = $this->graduationService->store($dataValid);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
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
        $response = $this->graduationService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    public function listBySport(Sport $sport, Academy $academy)
    {
        $response = $this->graduationService->listBySport($sport->id, $academy->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

}
