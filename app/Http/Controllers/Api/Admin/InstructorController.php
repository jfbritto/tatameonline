<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\InstructorService;
use App\Models\User;
use App\Models\Academy;
use Illuminate\Support\Facades\Storage;
use Arisharyanto\Laracrop\Laracrop;
use Intervention\Image\Facades\Image;

class InstructorController extends Controller
{
    private $instructorService;

    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }

    public function index(Academy $academy)
    {
        $response = $this->instructorService->index($academy->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    public function find($id)
    {
        $response = $this->instructorService->find($id);

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
                'isInstructor' => 1,
                'isStudent' => 0,
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

            $response = $this->instructorService->store($data);

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

            $response = $this->instructorService->update($data);
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

        $response = $this->instructorService->editPass($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    // public function editAvatar(Request $request)
    // {

    //     // dd($request->all());

    //     $dataValid = $request->validate([
    //         'id_user_avatar' => 'required',
    //         'avatar' => 'required|',
    //         'idAcademy' => 'required',
    //     ]);

    //     $user = User::where('id', '=', $request->id_user_avatar)->first();

    //     // dd($request->all());

    //     $nameFile = $user->avatar;
    //     // if ( $request->hasfile('avatar') && $request->file('avatar')->isValid() ) {
    //         $nameFile = Laracrop::cropImage($request->input('avatar'));
    //         Storage::delete("users/{$user->avatar}");
    //         Image::make(public_path("filetmp/{$nameFile}"))->resize(200, 200)->save(storage_path("app/public/users/{$nameFile}"));
    //         $data = ['id_user' => $user->id, 'avatar' => $nameFile, 'idAcademy' => $request->idAcademy];

    //         $response = $this->instructorService->editAvatar($data);
    //         Laracrop::cleanCropTemp();

    //     // }else{
    //     //     return response()->json(['status'=>'error', 'message'=>'Arquivo enviado inválido!'], 201);
    //     // }

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 201);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    // }

    public function destroy($id)
    {
        $response = $this->instructorService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    public function activate($id)
    {
        $response = $this->instructorService->activate($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
}
