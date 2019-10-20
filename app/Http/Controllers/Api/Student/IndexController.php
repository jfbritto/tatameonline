<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Services\LessonService;
use App\Services\PresenceService;
use App\Services\InvoiceService;
use App\Models\User;

class IndexController extends Controller
{
    private $presenceService;
    private $lessonService;
    private $invoiceService;

    public function __construct(PresenceService $presenceService, LessonService $lessonService, InvoiceService $invoiceService)
    {
        $this->presenceService = $presenceService;
        $this->lessonService = $lessonService;
        $this->invoiceService = $invoiceService;
    }

    public function mainFunction(User $user)
    {
        $nextLesson = $this->lessonService->nextLesson($user->id);
        $checkLesson = $this->lessonService->checkLesson($user->id);
        $openLastPresencesByStudent = $this->presenceService->openLastPresencesByStudent($user->id);
        $invoiceDue = $this->invoiceService->invoiceDue($user->id);

        $data = ['nextLesson'=>$nextLesson,'checkLesson'=>$checkLesson,'openLastPresencesByStudent'=>$openLastPresencesByStudent, 'invoiceDue' => $invoiceDue];

        if($nextLesson['status'] == 'success' && $checkLesson['status'] == 'success' && $openLastPresencesByStudent['status'] == 'success' && $invoiceDue['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$data], 201);

        return response()->json(['status'=>'error', 'message'=>$data], 500);
    }

}
