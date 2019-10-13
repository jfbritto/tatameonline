<?php

namespace App\Http\Controllers\Web\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BugController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;

        return view('student.bug.home', ['student' => $user]);
    }

}
