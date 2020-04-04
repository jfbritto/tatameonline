<?php

namespace App\Http\Controllers\Web\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        return view('instructor.home');
    }

}
