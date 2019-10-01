<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\UserGraduationService;
use App\Models\User;
use App\Models\Academy;

class UserGraduationController extends Controller
{
    private $userGraduationService;

    public function __construct(UserGraduationService $userGraduationService)
    {
        $this->userGraduationService = $userGraduationService;
    }

    public function index(User $user)
    {
        $response = $this->userGraduationService->index($user->id);

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
            'startDate' => 'required',
            'idUser' => 'required',
            'idGraduation' => 'required',
            ]);
            
        $data = [
            'startDate' => $request->startDate,
            'endDate' => null,
            'isActive' => 1,
            'idUser' => $request->idUser,
            'idGraduation' => $request->idGraduation,
        ];
        
        $response = $this->userGraduationService->store($data);
        
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
        $response = $this->userGraduationService->destroy($id);
        
        if($response['status'] == 'success')
        return response()->json(['status'=>'success'], 201);
        
        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
    
    public function listActivesByUser(User $user)
    {
        $response = $this->userGraduationService->listActivesByUser($user->id);
    
        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
}