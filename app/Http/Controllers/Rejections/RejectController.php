<?php

namespace App\Http\Controllers\Rejections;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\NotificationModules\NotificationService;

class RejectController extends Controller
{
    protected $notificationService;

    public function __construct ()
    {
        $this->middleware('auth:teacher');
        $this->notificationService = new NotificationService();
    }

    public function __invoke (Project $project, Request $request)
    {
        $group = $project->group()->first();

        if (! $group->requested(Auth::guard()->id())) abort(404);

        $request->validate([
            'comment' => 'required',
        ]);

        $project->rejections()->create([
            'comment' => $request->comment,
            'teacher_id' => Auth::guard()->id(),
        ]);

        $group->supervisorRequests()->where('teacher_id', Auth::guard()->id())->delete();

        $this->sendNotifications($group);

        return redirect()->back();
    }

    protected function sendNotifications (Group $group)
    {
        $FcmTokens = [];

        foreach ($group->members()->get() as $member) $FcmTokens[] = $member->student()->first()->device_token;

        $notification = new Request();
        $notification->setMethod('POST');
        $notification->request->add([
            'FcmToken' => $FcmTokens,
            'title' => 'Supervision Request',
            'description' => Auth::guard()->user()->name . " has rejected your supervision request.",
            'icon' => Auth::guard()->user()->avatar(),
        ]);

        $this->notificationService->send($notification);
    }
}
