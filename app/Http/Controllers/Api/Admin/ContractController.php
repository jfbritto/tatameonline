<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ContractService;
use App\Models\User;
use App\Models\Academy;

class ContractController extends Controller
{
    private $contractService;

    public function __construct(ContractService $contractService)
    {
        $this->contractService = $contractService;
    }

    public function index(User $user)
    {
        $response = $this->contractService->index($user->id);

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
            'signatureDate' => 'required',
            'months' => 'required',
            'monthlyPayment' => 'required',
            'expiryDay' => 'required',
            'idUser' => 'required',
        ]);

        $data = [
            'signatureDate' => $request->signatureDate,
            'months' => $request->months,
            'monthlyPayment' => $request->monthlyPayment,
            'expiryDay' => $request->expiryDay,
            'idUser' => $request->idUser,
            'idActive' => 1,
        ];

        $response = $this->contractService->store($data);

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
        $response = $this->contractService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
}