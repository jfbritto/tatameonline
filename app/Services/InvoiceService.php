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

    public function revenueByMonth($id)
    {
        $response = [];

        try{

            $receive = 0;
            $received = 0;
            $late = 0;

            $receive_obj = DB::select( DB::raw("select
                                                sum(inv.value) as total
                                            from
                                                invoices inv
                                                join users us
                                            where
                                                us.idAcademy = ".$id."
                                                and us.isStudent = 1
                                                and date_format(inv.dueDate, '%Y-%m') = date_format(now(), '%Y-%m')"));

            $received_obj = DB::select( DB::raw("select
                                                sum(inv.value) as total
                                            from
                                                invoices inv
                                                join users us
                                            where
                                                us.idAcademy = ".$id."
                                                and us.isStudent = 1
                                                and inv.isPaid = 1
                                                and date_format(inv.dueDate, '%Y-%m') = date_format(now(), '%Y-%m')"));

            $late_obj = DB::select( DB::raw("select
                                                sum(inv.value) as total
                                            from
                                                invoices inv
                                                join users us
                                            where
                                                us.idAcademy = ".$id."
                                                and us.isStudent = 1
                                                and inv.isPaid = 0
                                                and date_format(inv.dueDate, '%Y-%m') = date_format(now(), '%Y-%m')
                                                and inv.dueDate < date_format(now(), '%Y-%m-%d')"));

            if($receive_obj[0]->total != null)
                $receive = number_format($receive_obj[0]->total,2,',','.');

            if($received_obj[0]->total != null)
                $received = number_format($received_obj[0]->total,2,',','.');

            if($late_obj[0]->total != null)
                $late = number_format($late_obj[0]->total,2,',','.');

            $revenue = ['receive'=>$receive, 'received'=>$received, 'late'=>$late];

            $response = ['status' => 'success', 'data' => $revenue];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
