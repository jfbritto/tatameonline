<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Services\LessonService;
use App\Services\PresenceService;
use App\Services\InvoiceService;
use App\Services\AcademyService;
use App\Models\User;

class IndexController extends Controller
{
    private $presenceService;
    private $lessonService;
    private $invoiceService;
    private $academyService;

    public function __construct(PresenceService $presenceService, LessonService $lessonService, InvoiceService $invoiceService, AcademyService $academyService)
    {
        $this->presenceService  = $presenceService;
        $this->lessonService    = $lessonService;
        $this->invoiceService   = $invoiceService;
        $this->academyService   = $academyService;
    }

    public function mainFunction(User $user)
    {
        $nextLesson = $this->lessonService->nextLesson($user->id);
        $checkLesson = $this->lessonService->checkLesson($user->id);
        $openLastPresencesByStudent = $this->presenceService->openLastPresencesByStudent($user->id);
        $invoiceDue = $this->invoiceService->invoiceDue($user->id);
        $academy = $this->academyService->getById($user->idAcademy);

        $data = ['nextLesson'=>$nextLesson,'checkLesson'=>$checkLesson,'openLastPresencesByStudent'=>$openLastPresencesByStudent, 'invoiceDue' => $invoiceDue, 'academy' => $academy];

        if($nextLesson['status'] == 'success' && $checkLesson['status'] == 'success' && $openLastPresencesByStudent['status'] == 'success' && $invoiceDue['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$data], 201);

        return response()->json(['status'=>'error', 'message'=>$data], 500);
    }

}
