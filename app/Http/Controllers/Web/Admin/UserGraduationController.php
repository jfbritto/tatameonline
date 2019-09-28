<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserGraduationController extends Controller
{
    public function index(User $user)
    {
        return view('admin.userGraduation.home', ['student' => $user]);
    }

    public function create()
    {
        return view('admin.userGraduation.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        return view('admin.userGraduation.show', ['student' => $user]);
    }

    public function edit(User $user)
    {
        return view('admin.userGraduation.edit', ['user' => $user]);
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
