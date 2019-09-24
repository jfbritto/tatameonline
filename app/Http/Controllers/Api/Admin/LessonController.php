<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\LessonService;
use App\Models\User;
use App\Models\Academy;

class LessonController extends Controller
{
    private $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function index(Academy $academy)
    {
        $response = $this->lessonService->index($academy->id);

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
            'teacher' => 'required',
            'weekDay' => 'required',
            'hour' => 'required',
            'idSport' => 'required',
            'idAcademy' => 'required',
        ]);

        $data = [
            'teacher' => $request->teacher,
            'weekDay' => $request->weekDay,
            'hour' => $request->hour,
            'isActive' => 1,
            'idAcademy' => $request->idAcademy,
            'idSport' => $request->idSport,
        ];

        // return $data;

        $response = $this->lessonService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
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
        $response = $this->lessonService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }
}
