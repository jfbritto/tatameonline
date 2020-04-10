<?php

namespace App\Http\Controllers\Web\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BugController extends Controller
{
    public function index()
    {
        return view('instructor.bug.home');
    }

}
