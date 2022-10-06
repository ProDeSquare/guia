<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\NotificationModules\NotificationService;

class AcceptRequestController extends Controller
{
    protected $notificationService;

    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->notificationService = new NotificationService();
    }

    public function __invoke(Group $group, Project $project)
    {
        $group->supervisorRequests()->where('teacher_id', Auth::guard()->id())->update([
            'accepted' => 1,
        ]) && $project->update([
            'status' => 1,
        ]);

        $group->supervisorRequests()->delete();

        $this->sendNotifications($group, $project);

        return redirect()->route('view.group.projects', $group);
    }

    protected function sendNotifications (Group $group, Project $project)
    {
        $FcmTokens = [];

        foreach ($group->members()->get() as $member) $FcmTokens[] = $member->student()->first()->device_token;

        $notification = new Request();
        $notification->setMethod('POST');
        $notification->request->add([
            'FcmToken' => $FcmTokens,
            'title' => 'Supervision Request',
            'description' => Auth::guard()->user()->name . " has accepted supervision request for \"" . $project->title . "\"",
            'icon' => Auth::guard()->user()->avatar(),
        ]);

        $this->notificationService->send($notification);
    }
}
