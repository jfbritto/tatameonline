<?php

namespace App\Http\Controllers\Web\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Sport;
use App\Services\InstructorService;

class LessonController extends Controller
{
    private $instructorService;

    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }

    public function index()
    {
        $sports = Sport::get();

        $instructors = $this->instructorService->index(auth()->user()->idAcademy);
        $instructors = $instructors['data'];

        return view('instructor.lesson.home', ['sports' => $sports, 'instructors' => $instructors]);
    }


    public function show(Lesson $lesson)
    {
        $week_day = ['1'=>'Segunda','2'=>'Terça','3'=>'Quarta','4'=>'Quinta','5'=>'Sexta','6'=>'Sábado','7'=>'Domingo'];

        $sports = Sport::get();
        foreach ($sports as $sport) {
            $sport_name[$sport->id] = $sport->name;
        }

        $instructor = $this->instructorService->find($lesson->teacher)['data'];
        $lessons = $this->instructorService->getLessons($lesson->teacher)['data'];

        $academy = auth()->user()->academy;
        return view('instructor.lesson.show', ['lesson' => $lesson, 'academy' => $academy, 'week_day' => $week_day, 'sport_name' => $sport_name, 'instructor' => $instructor, 'lessons' => $lessons]);
    }

}
