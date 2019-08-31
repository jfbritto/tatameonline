<?php

namespace App\Http\Controllers\Web\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Graduation;

class GraduationController extends Controller
{
    public function index()
    {
        return view('root.graduation.home');
    }

    public function create()
    {
        return view('root.graduation.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Graduation $graduation)
    {
        return view('root.graduation.show', ['graduation' => $graduation]);
    }

    public function edit(Graduation $graduation)
    {
        return view('root.graduation.edit', ['graduation' => $graduation]);
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
