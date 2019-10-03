<?php

namespace App\Http\Controllers\Api\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SportService;
use App\Models\Sport;

class SportController extends Controller
{
    private $sportService;

    public function __construct(SportService $sportService)
    {
        $this->sportService = $sportService;
    }

    public function index()
    {
        $response = $this->sportService->index();

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
            'name' => 'required'
        ]);

        $response = $this->sportService->store($dataValid);

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
        $response = $this->sportService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
}
