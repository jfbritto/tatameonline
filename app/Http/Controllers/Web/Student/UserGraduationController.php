<?php

namespace App\Http\Controllers\Web\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserGraduationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('student.graduation.home', ['student' => $user]);
    }

    public function create()
    {
        return view('student.userGraduation.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        return view('student.userGraduation.show', ['student' => $user]);
    }

    public function edit(User $user)
    {
        return view('student.userGraduation.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
