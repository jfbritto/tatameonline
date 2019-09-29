<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PresenceService;
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
        // $dataValid = $request->validate([
        //     'signatureDate' => 'required',
        //     'months' => 'required',
        //     'monthlyPayment' => 'required',
        //     'expiryDay' => 'required',
        //     'idUser' => 'required',
        // ]);

        // $data = [
        //     'signatureDate' => $request->signatureDate,
        //     'months' => $request->months,
        //     'monthlyPayment' => $request->monthlyPayment,
        //     'expiryDay' => $request->expiryDay,
        //     'idUser' => $request->idUser,
        //     'idActive' => 1,
        // ];

        // $response = $this->presenceService->store($data);

        // if($response['status'] == 'success')
        //     return response()->json(['status'=>'success'], 201);
            
        // return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
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