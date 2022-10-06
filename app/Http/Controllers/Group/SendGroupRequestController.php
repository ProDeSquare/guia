<?php

namespace App\Http\Controllers\Group;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\GroupModules\GroupService;
use App\Modules\NotificationModules\NotificationService;

class SendGroupRequestController extends Controller
{
    protected $groupService;
    protected $notificationService;

    public function __construct ()
    {
        $this->middleware('auth:student');
        $this->groupService = new GroupService();
        $this->notificationService = new NotificationService();
    }

    public function __invoke (Student $student)
    {
        if (Auth::guard()->id() === $student->id) abort(403);

        if (! Auth::guard()->user()->isGrouped()) {
            $this->groupService->createNewGroupAndAddStudent();
        }

        else if ($this->groupService->groupExceedsMembersLimit(Auth::guard()->user()->group()->first()->group()->first())) {
            abort(403);
        }

        $group_id = Auth::guard()->user()->group()->first()->group_id;

        if ($student->isGrouped()) return redirect()->back();
        if ($student->hasAlreadyRequestedForCurrentGroup($group_id)) return redirect()->back();

        $student->group()->create([
            'group_id' => $group_id,
        ]);

        $student->device_token && $this->sendNotification($student);

        return redirect()->route('student.profile', $student->id)->withSuccess('Requested!');
    }

    protected function sendNotification (Student $student)
    {
        $notification = new Request();
        $notification->setMethod('POST');
        $notification->request->add([
            'FcmToken' => [$student->device_token],
            'title' => 'Group Request',
            'description' => Auth::guard()->user()->name . " has sent you a group request.",
            'icon' => $student->avatar(),
        ]);

        $this->notificationService->send($notification);
    }
}
