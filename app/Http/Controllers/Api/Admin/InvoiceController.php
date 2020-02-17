<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\InvoiceService;
use App\Models\User;
use App\Models\Contract;
use App\Models\Academy;

class InvoiceController extends Controller
{
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(Contract $contract)
    {
        $response = $this->invoiceService->index($contract->id);

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
        //
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
        $response = $this->invoiceService->destroy($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
    
    public function reportPayment($id, $idUser)
    {       
        $response = $this->invoiceService->reportPayment($id, $idUser);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);
            
        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
}