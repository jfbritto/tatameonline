<?php

namespace App\Http\Controllers\Web\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BugController extends Controller
{
    public function index()
    {
        return view('root.bug.home');
    }

}
