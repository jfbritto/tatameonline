<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PresenceService;
use App\Models\User;
use App\Models\UserGraduation;

class PresenceController extends Controller
{
    private $presenceService;

    public function __construct(PresenceService $presenceService)
    {
        $this->presenceService = $presenceService;
    }

    public function index(User $user, UserGraduation $userGraduation)
    {
        $response = $this->presenceService->index($user->id, $userGraduation->id);

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
        // $response = $this->presenceService->destroy($id);

        // if($response['status'] == 'success')
        //     return response()->json(['status'=>'success'], 201);

        // return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
}
