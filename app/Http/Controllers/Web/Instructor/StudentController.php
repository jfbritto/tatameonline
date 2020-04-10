<?php

namespace App\Http\Controllers\Web\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Arisharyanto\Laracrop\Laracrop;
use Intervention\Image\Facades\Image;
use App\Services\StudentService;

class StudentController extends Controller
{
    public function index()
    {
        return view('instructor.student.home');
    }

    public function show(User $user)
    {
        return view('instructor.student.show', ['student' => $user]);
    }

}
