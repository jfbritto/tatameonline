<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Invoice;
use App\Models\User;
use DB;
use Exception;
use App\Mail\SendMailUser;
use Illuminate\Support\Facades\Mail;

class InvoiceService
{
    public function index($id)
    {
        $response = [];

        try{

            $invoices = DB::table('invoices')->where('idContract', '=', $id)->orderBy('dueDate')->get();

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

            $tokenPaiment = md5($id.date("YmdHis"));

            DB::table('invoices')
                            ->where('id', $id)
                            ->update(['isPaid' => 1, 'paymentDate' => date('Y-m-d'), 'tokenPayment' => $tokenPaiment]);

            $invoice = Invoice::where('id', '=', $id)->first();
            $user = User::where('id', '=', $invoice->idUser)->first();
            //enviar email
            Mail::to($user->email)->queue(new SendMailUser($user, "2", "", "", $invoice));

            DB::commit();

            $response = ['status' => 'success'];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function revenueByMonth($id, $date)
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
                                                    join users us on inv.idUser=us.id
                                                where
                                                    us.idAcademy = ".$id."
                                                    and us.isStudent = 1
                                                    and us.isActive = 1
                                                    and date_format(inv.dueDate, '%Y-%m') = '".$date."'"));

            $receive_list_obj = DB::select( DB::raw("select
                                                        us.id, us.name, inv.dueDate, inv.value
                                                    from
                                                        invoices inv
                                                        join users us on inv.idUser=us.id
                                                    where
                                                        us.idAcademy = ".$id."
                                                        and us.isStudent = 1
                                                        and us.isActive = 1
                                                        and date_format(inv.dueDate, '%Y-%m') = '".$date."'"));

            $received_obj = DB::select( DB::raw("select
                                                    sum(inv.value) as total
                                                from
                                                    invoices inv
                                                    join users us on inv.idUser=us.id
                                                where
                                                    us.idAcademy = ".$id."
                                                    and us.isStudent = 1
                                                    and us.isActive = 1
                                                    and inv.isPaid = 1
                                                    and date_format(inv.dueDate, '%Y-%m') = '".$date."'"));

            $received_list_obj = DB::select( DB::raw("select
                                                    us.id, us.name, inv.dueDate, inv.value
                                                from
                                                    invoices inv
                                                    join users us on inv.idUser=us.id
                                                where
                                                    us.idAcademy = ".$id."
                                                    and us.isStudent = 1
                                                    and us.isActive = 1
                                                    and inv.isPaid = 1
                                                    and date_format(inv.dueDate, '%Y-%m') = '".$date."'"));

            $late_obj = DB::select( DB::raw("select
                                                sum(inv.value) as total
                                            from
                                                invoices inv
                                                join users us on inv.idUser=us.id
                                            where
                                                us.idAcademy = ".$id."
                                                and us.isStudent = 1
                                                and us.isActive = 1
                                                and inv.isPaid = 0
                                                and date_format(inv.dueDate, '%Y-%m') = '".$date."'
                                                and inv.dueDate < date_format(now(), '%Y-%m-%d')"));

            $late_list_obj = DB::select( DB::raw("select
                                                    us.id, us.name, inv.dueDate, inv.value
                                                from
                                                    invoices inv
                                                    join users us on inv.idUser=us.id
                                                where
                                                    us.idAcademy = ".$id."
                                                    and us.isStudent = 1
                                                    and us.isActive = 1
                                                    and inv.isPaid = 0
                                                    and date_format(inv.dueDate, '%Y-%m') = '".$date."'
                                                    and inv.dueDate < date_format(now(), '%Y-%m-%d')"));

            $list_debtors = DB::select( DB::raw("select
                                                    us.id, us.name, count(*) as total
                                                from
                                                    invoices inv
                                                    join users us on inv.idUser=us.id
                                                where
                                                    us.idAcademy = ".$id."
                                                    and us.isStudent = 1
                                                    and us.isActive = 1
                                                    and inv.isPaid = 0
                                                    and inv.dueDate < date_format(now(), '%Y-%m-%d')
                                                group by
                                                    us.id, us.name
                                                having
                                                    total > 1"));

            if($receive_obj[0]->total != null)
                $receive = number_format($receive_obj[0]->total,2,',','.');

            if($received_obj[0]->total != null)
                $received = number_format($received_obj[0]->total,2,',','.');

            if($late_obj[0]->total != null)
                $late = number_format($late_obj[0]->total,2,',','.');

            $revenue = ['receive'=>$receive, 'list_receive' => $receive_list_obj, 'received'=>$received, 'list_received' => $received_list_obj, 'late'=>$late, 'list_late' => $late_list_obj, 'debtors' => $list_debtors];

            $response = ['status' => 'success', 'data' => $revenue];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
