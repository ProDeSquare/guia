<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Teacher;
use Illuminate\Http\Request;
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

        $this->sendNotification($teacher);

        return redirect()->route('teacher.profile', $teacher);
    }

    protected function sendNotification(Teacher $teacher)
    {
        $notification = new Request();
        $notification->setMethod('POST');
        $notification->request->add([
            'FcmToken' => [$teacher->device_token],
            'title' => 'Group Request',
            'description' => Auth::guard()->user()->name . " has sent you a supervision request.",
            'icon' => Auth::guard()->user()->avatar(),
        ]);

        $this->notificationService->send($notification);
    }
}
