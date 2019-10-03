<?php

namespace App\Http\Controllers\Api\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AcademyService;
use App\Models\Academy;

class AcademyController extends Controller
{
    private $academyService;

    public function __construct(AcademyService $academyService)
    {
        $this->academyService = $academyService;
    }

    public function index()
    {
        $response = $this->academyService->index();

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
            'phone' => 'required',
            'responsable' => 'required',
            'phoneResponsable' => 'required',
        ]);

        $response = $this->academyService->store($dataValid);

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
        $response = $this->academyService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
}
