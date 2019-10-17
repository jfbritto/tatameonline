<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Invoice;

class SiteController extends Controller
{
    public function index()
    {
        $academies = Academy::where('isActive', '=', 1)->get();

        return view('index', ['academies'=>$academies]);
    }

    public function academy_area($siteName)
    {
        $academy = Academy::where('siteName', '=', $siteName)->where('isActive', '=', 1)->first();

        return view('index-site', ['academy'=>$academy]);
    }

    public function receipt($token)
    {
        $invoice = Invoice::where('tokenPayment', '=', $token)->first();

        if(!$invoice)
            $invoice = '';

        return view('receipt', ['invoice'=>$invoice]);
    }

}
