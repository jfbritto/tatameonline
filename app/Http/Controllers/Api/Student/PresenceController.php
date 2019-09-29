<?php

namespace App\Http\Controllers\Api\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PresenceService;
use App\Models\User;
use App\Models\Academy;
use App\Models\Lesson;

class PresenceController extends Controller
{
    private $presenceService;

    public function __construct(PresenceService $presenceService)
    {
        $this->presenceService = $presenceService;
    }

    
    public function store(Request $request)
    {
        $dataValid = $request->validate([
            'idRegistration' => 'required',
            'idUserGraduation' => 'required',
            ]);
            
        $data = [
            'idRegistration' => $request->idRegistration,
            'idUserGraduation' => $request->idUserGraduation,
            'checkedHour' => date("Y-m-d H:i:s"),
        ];
        
        // return $data;
        
        $response = $this->presenceService->store($data);
        
        if($response['status'] == 'success')
        return response()->json(['status'=>'success'], 201);
        
        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
    
    
    public function openLastPresencesByStudent(User $user)
    {
        $response = $this->presenceService->openLastPresencesByStudent($user->id);
    
        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
    
}
