<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\NotificationModules\NotificationService;

class RequestController extends Controller
{
    protected $notificationService;

    public function __construct()
    {
        $this->middleware('auth:student');
        $this->notificationService = new NotificationService();
    }

    public function __invoke(Teacher $teacher)
    {
        $group = Auth::guard()->user()->mainGroup();

        if (!$group->requested($teacher->id)) {
            $group->supervisorRequests()->create([
                'teacher_id' => $teacher->id,
            ]);
        }

        $teacher->device_token && $this->notificationService->send($this->notificationService->prepare(
            [$teacher->device_token],
            'New Supervision Request',
            Auth::guard()->user()->name . " has sent you a supervision request.",
            Auth::guard()->user()->avatar(),
            route('supervision.requests'),
        ));

        return redirect()->route('teacher.profile', $teacher);
    }
}
