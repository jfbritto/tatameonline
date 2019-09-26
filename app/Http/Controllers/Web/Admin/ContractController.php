<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ContractController extends Controller
{
    public function index(User $user)
    {
        return view('admin.contract.home', ['student' => $user]);
    }

    public function create()
    {
        return view('admin.contract.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        return view('admin.contract.show', ['student' => $user]);
    }

    public function edit(User $user)
    {
        return view('admin.contract.edit', ['user' => $user]);
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
