<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Invoice;

class SiteController extends Controller
{
    public function index()
    {

        // $isMobile = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        $isApp = preg_match("/(Build)/i", $_SERVER["HTTP_USER_AGENT"]);

        $academies = Academy::where('isActive', '=', 1)->get();

        if($isApp){
            echo $_SERVER["HTTP_USER_AGENT"];
            // return view('index', ['academies'=>$academies]);
        }else{
            return view('index', ['academies'=>$academies]);
        }

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
