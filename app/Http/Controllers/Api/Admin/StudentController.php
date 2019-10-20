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

    public function find($id)
    {
        $response = $this->studentService->find($id);

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
            'param' => 'required',
        ]);


        if($request->param == 'new'){

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'isStudent' => 1,
                'idAcademy' => $request->idAcademy,
                'phone' => $request->phone,
                'cpf' => $request->cpf,
                'birth' => $request->birth,
                'responsible' => $request->responsible,
                'phoneResponsible' => $request->phoneResponsible,
                'zipCode' => $request->zipCode,
                'city' => $request->city,
                'neighborhood' => $request->neighborhood,
                'address' => $request->address,
                'number' => $request->number,
                'complement' => $request->complement,
                'observation' => $request->observation,
                'password' => bcrypt('12345678'),
            ];

            $response = $this->studentService->store($data);

        }else if($request->param == 'edit'){

            $data = [
                'id' => $request->id_user,
                'idAcademy' => $request->idAcademy,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'cpf' => $request->cpf,
                'birth' => $request->birth,
                'responsible' => $request->responsible,
                'phoneResponsible' => $request->phoneResponsible,
                'zipCode' => $request->zipCode,
                'city' => $request->city,
                'neighborhood' => $request->neighborhood,
                'address' => $request->address,
                'number' => $request->number,
                'complement' => $request->complement,
                'observation' => $request->observation,
            ];

            $response = $this->studentService->update($data);
        }

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

    public function editPass(Request $request)
    {

        $dataValid = $request->validate([
            'id_user' => 'required',
            'pass' => 'required',
            'idAcademy' => 'required',
        ]);

        $data = [
            'id' => $request->id_user,
            'pass' => $request->pass,
            'idAcademy' => $request->idAcademy,
        ];

        $response = $this->studentService->editPass($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    public function destroy($id)
    {
        $response = $this->studentService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    public function activate($id)
    {
        $response = $this->studentService->activate($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
}
