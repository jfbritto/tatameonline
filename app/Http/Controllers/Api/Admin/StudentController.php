<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\StudentService;
use App\Models\User;
use App\Models\Academy;

class StudentController extends Controller
{
    private $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index(Academy $academy)
    {
        $response = $this->studentService->index($academy->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dataValid = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'idAcademy' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'isStudent' => 1,
            'idAcademy' => $request->idAcademy,
            'password' => bcrypt('12345678'),
        ];

        // return $data;

        $response = $this->studentService->store($data);

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
        $response = $this->studentService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
}