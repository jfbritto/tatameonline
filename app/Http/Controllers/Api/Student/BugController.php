<?php

namespace App\Http\Controllers\Api\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BugService;

class BugController extends Controller
{
    private $bugService;

    public function __construct(BugService $bugService)
    {
        $this->bugService = $bugService;
    }


    public function store(Request $request)
    {
        $dataValid = $request->validate([
            'type' => 'required',
            'description' => 'required',
            'idUser' => 'required',
            ]);

        $response = $this->bugService->store($dataValid);

        if($response['status'] == 'success')
        return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }


}
