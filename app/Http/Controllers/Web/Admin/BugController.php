<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BugController extends Controller
{
    public function index()
    {
        return view('admin.bug.home');
    }

}
