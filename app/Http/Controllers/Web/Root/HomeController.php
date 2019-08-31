<?php

namespace App\Http\Controllers\Web\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    
    public function index()
    {
        return view('root.home');
    }
}
