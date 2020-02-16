<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AcademyService;
use App\Models\Academy;
use App\Models\User;

class AcademyController extends Controller
{
    private $academyService;

    public function __construct(AcademyService $academyService)
    {
        $this->academyService = $academyService;
    }

    public function index(Academy $academy)
    {
        $response = $this->academyService->getById($academy->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
    
    public function checkuserpass(User $user, $password)
    {
        return $response = $this->academyService->checkuserpass($user->id, $password);

        /* if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500); */
    }
    
    public function updateToken(Academy $academy)
    {
        $response = $this->academyService->updateToken($academy->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

}
