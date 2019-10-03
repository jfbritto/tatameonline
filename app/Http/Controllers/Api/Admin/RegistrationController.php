<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\RegistrationService;
use App\Models\User;
use App\Models\Academy;
use App\Models\Lesson;

class RegistrationController extends Controller
{
    private $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function index(Lesson $lesson)
    {
        $response = $this->registrationService->index($lesson->id);

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
            'idLesson' => 'required',
            'idUser' => 'required',
        ]);

        $data = [
            'idLesson' => $request->idLesson,
            'idUser' => $request->idUser,
        ];

        // return $data;

        $response = $this->registrationService->store($data);

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
        $response = $this->registrationService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
}
