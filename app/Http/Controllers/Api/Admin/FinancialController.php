<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\InvoiceService;
use App\Models\Academy;

class FinancialController extends Controller
{
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(Academy $academy)
    {
        $response = $this->invoiceService->revenueByMonth($academy->id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 500);
    }

}
