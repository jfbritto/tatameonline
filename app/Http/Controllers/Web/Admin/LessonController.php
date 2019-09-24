<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Sport;

class LessonController extends Controller
{
    public function index()
    {
        return view('admin.lesson.home');
    }

    public function create()
    {
        $sports = Sport::get();

        return view('admin.lesson.create', ['sports' => $sports]);
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
