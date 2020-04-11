<?php

namespace App\Http\Controllers\Api\Root;

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

    public function index()
    {
        $response = $this->bugService->index();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

    public function setRead($id)
    {
        $response = $this->bugService->setRead($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

}
