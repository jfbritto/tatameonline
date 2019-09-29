<?php

namespace App\Http\Controllers\Api\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\LessonService;
use App\Models\User;
use App\Models\Academy;
use App\Models\Lesson;

class LessonController extends Controller
{
    private $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function index(User $user)
    {
        $response = $this->lessonService->listLessonsByUser($user->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

    public function nextLesson(User $user)
    {
        $response = $this->lessonService->nextLesson($user->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

    public function checkLesson(User $user)
    {
        $response = $this->lessonService->checkLesson($user->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
    
}
