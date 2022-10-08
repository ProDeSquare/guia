<?php

namespace App\Http\Controllers\Group;

use App\Models\Student;
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

        $student->device_token && $this->notificationService->send($this->notificationService->prepare(
            [$student->device_token],
            'Group Request',
            Auth::guard()->user()->name . " has sent you a group request.",
            $student->avatar(),
            route('requests.view'),
        ));

        return redirect()->route('student.profile', $student->id)->withSuccess('Requested!');
    }
}
