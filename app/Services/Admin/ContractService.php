<?php

namespace App\Services\Admin;

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

            $contracts = DB::table('contracts')->where('idUser', '=', $id)->get();

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

    public function destroy($id)
    {
        $response = [];

        try{
            DB::beginTransaction();

            DB::table('contract')
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
}