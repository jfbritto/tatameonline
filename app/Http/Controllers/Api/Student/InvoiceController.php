<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Services\InvoiceService;
use App\Models\User;

class IndexController extends Controller
{
    private $presenceService;
    private $lessonService;
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function invoiceDue(User $user)
    {
        $data = $this->invoiceService->invoiceDue($user->id);

        if($data['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$data['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$data]['data'], 500);
    }

}
