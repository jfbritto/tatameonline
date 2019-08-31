<?php

namespace App\Http\Controllers\Web\Root;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sport;

class SportController extends Controller
{
    public function index()
    {
        return view('root.sport.home');
    }

    public function create()
    {
        return view('root.sport.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Sport $sport)
    {
        return view('root.sport.show', ['sport' => $sport]);
    }

    public function edit(Sport $sport)
    {
        return view('root.sport.edit', ['sport' => $sport]);
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
