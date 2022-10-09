<?php

namespace App\Http\Controllers\Rejections;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\GroupModules\GroupService;
use App\Modules\NotificationModules\NotificationService;

class RejectController extends Controller
{
    protected $groupService;
    protected $notificationService;

    public function __construct ()
    {
        $this->middleware('auth:teacher');
        $this->groupService = new GroupService();
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

        $this->notificationService->send($this->notificationService->prepare(
            $this->groupService->getDeviceTokens($group),
            'Supervision Request Rejected',
            Auth::guard()->user()->name . " has rejected your supervision request saying \"" . $request->comment . "\"",
            Auth::guard()->user()->avatar(),
            route('project.view', $project),
        ));

        return redirect()->back();
    }
}
