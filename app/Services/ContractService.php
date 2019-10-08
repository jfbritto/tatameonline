<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Invoice;
use DB;
use Exception;

class ContractService
{
    public function index($id)
    {
        $response = [];

        try{

            $contracts = DB::table('contracts')
                                    ->where('idUser', '=', $id)
                                    ->select('contracts.*',
                                    (DB::raw("(select count(*) from invoices where idContract = contracts.id and isPaid = 1) as fatPay")),
                                    (DB::raw("(select count(*) from invoices where idContract = contracts.id and isPaid = 0) as fatNotPay")) )
                                    ->orderBy('contracts.id', 'desc')
                                    ->get();

            $response = ['status' => 'success', 'data' => $contracts];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $contract = Contract::create($data);

            for ($i=0; $i < $data['months']; $i++) {

                $data_invoice = [];

                $dueDate = date('Y-m-'.$data['expiryDay'], strtotime("+".$i." month"));

                $data_invoice = [
                    'value' => $data['monthlyPayment'],
                    'dueDate' => $dueDate,
                    'isPaid' => false,
                    'paymentDate' => null,
                    'idUser' => $data['idUser'],
                    'idContract' => $contract->id,
                ];

                Invoice::create($data_invoice);
            }


            DB::commit();

            $response = ['status' => 'success', 'data' => $contract];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function renew(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $return = DB::table('contracts')
                    ->where('idUser', $data['idUser'])
                    ->where('isActive', 1)
                    ->update(['isActive' => 0]);

            if($return){

                $contract = Contract::create($data);

                for ($i=0; $i < $data['months']; $i++) {

                    $data_invoice = [];

                    $dueDate = date('Y-m-'.$data['expiryDay'], strtotime("+".$i." month"));

                    $data_invoice = [
                        'value' => $data['monthlyPayment'],
                        'dueDate' => $dueDate,
                        'isPaid' => false,
                        'paymentDate' => null,
                        'idUser' => $data['idUser'],
                        'idContract' => $contract->id,
                    ];

                    Invoice::create($data_invoice);
                }

                DB::commit();

            }else{
                DB::rollBack();

                $response = ['status' => 'error', 'data' => "Nenhum contrato para renovação encontrado!"];
            }


            $response = ['status' => 'success', 'data' => $contract];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function destroy($id)
    {
        $response = [];

        try{
            DB::beginTransaction();

            DB::table('contracts')
            ->where('id', $id)
            ->update(['isActive' => 0]);

            DB::commit();

            $response = ['status' => 'success'];
        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function getActiveByUser($id)
    {
        $response = [];

        try{

            $contract = DB::table('contracts')
                                ->where('idUser', '=', $id)
                                ->where('isActive', '=', 1)
                                ->select('contracts.*',
                                (DB::raw("(select count(*) from invoices where idContract = contracts.id and isPaid = 1) as fatPay")),
                                (DB::raw("(select count(*) from invoices where idContract = contracts.id and isPaid = 0) as fatNotPay")) )
                                ->first();

            $response = ['status' => 'success', 'data' => $contract];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
