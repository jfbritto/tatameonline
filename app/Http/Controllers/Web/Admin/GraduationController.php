<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Graduation;

class GraduationController extends Controller
{
    public function index()
    {
        return view('admin.graduation.home');
    }

    public function create()
    {
        return view('admin.graduation.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Graduation $graduation)
    {
        return view('admin.graduation.show', ['graduation' => $graduation]);
    }

    public function edit(Graduation $graduation)
    {
        return view('admin.graduation.edit', ['graduation' => $graduation]);
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
