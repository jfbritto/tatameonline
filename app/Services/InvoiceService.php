<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Invoice;
use DB;
use Exception;

class InvoiceService
{
    public function index($id)
    {
        $response = [];

        try{

            $invoices = DB::table('invoices')->where('idContract', '=', $id)->get();

            $response = ['status' => 'success', 'data' => $invoices];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function reportPayment($id)
    {
        $response = [];

        try{
            DB::beginTransaction();

            DB::table('invoices')
                ->where('id', $id)
                ->update(['isPaid' => 1, 'paymentDate' => date('Y-m-d')]);

            DB::commit();

            $response = ['status' => 'success'];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}
