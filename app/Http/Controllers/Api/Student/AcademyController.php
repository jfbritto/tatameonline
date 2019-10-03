<?php

namespace App\Http\Controllers\Api\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AcademyService;
use App\Models\User;
use App\Models\Academy;
use App\Models\Lesson;

class AcademyController extends Controller
{
    private $academyService;

    public function __construct(AcademyService $academyService)
    {
        $this->academyService = $academyService;
    }

    public function checkToken(User $user, $token)
    {

        $response = $this->academyService->checkToken($user->academy->id, $token);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
    
}
