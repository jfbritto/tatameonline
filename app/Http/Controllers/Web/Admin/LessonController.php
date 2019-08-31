<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function index()
    {
        return view('admin.lesson.home');
    }

    public function create()
    {
        return view('admin.lesson.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Lesson $lesson)
    {
        return view('admin.lesson.show', ['lesson' => $lesson]);
    }

    public function edit(Lesson $lesson)
    {
        return view('admin.lesson.edit', ['lesson' => $lesson]);
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
