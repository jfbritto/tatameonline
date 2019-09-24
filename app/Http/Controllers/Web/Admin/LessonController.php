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
        $week_day = ['1'=>'Segunda','2'=>'Terça','3'=>'Quarta','4'=>'Quinta','5'=>'Sexta','6'=>'Sábado','7'=>'Domingo'];

        $sports = Sport::get();
        foreach ($sports as $sport) {
            $sport_name[$sport->id] = $sport->name;
        }

        $academy = auth()->user()->academy;
        return view('admin.lesson.show', ['lesson' => $lesson, 'academy' => $academy, 'week_day' => $week_day, 'sport_name' => $sport_name]);
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
