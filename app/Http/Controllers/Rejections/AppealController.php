<?php

namespace App\Http\Controllers\Rejections;

use App\Models\Group;
use App\Models\Appeal;
use App\Models\Project;
use App\Models\Teacher;
use App\Models\Rejection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\GroupModules\GroupService;
use App\Modules\NotificationModules\NotificationService;

class AppealController extends Controller
{
    protected $groupService;
    protected $notificationService;

    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->groupService = new GroupService();
        $this->notificationService = new NotificationService();
    }

    public function add(Request $request, Project $project, Rejection $rejection)
    {
        $project->rejections()->findOrFail($rejection->id);

        if ($project->status === 1) abort(403);

        if (!$this->projectBelongsToUser($project, $rejection)) abort(404);

        $appeal = $rejection->appeals()->create([
            'user_id' => Auth::guard()->id(),
            'guard' => Auth::guard()->user()->getGuardType(),

            ...$request->validate([
                'text' => 'required',
            ]),
        ]);

        $this->notify($project, $rejection, $appeal);

        return redirect(route('view.appeals', [$project, $rejection]) . "#appeal-" . $appeal->id);
    }

    public function show(Project $project, Rejection $rejection)
    {
        $project->rejections()->findOrFail($rejection->id);

        $group = Group::find($project->group_id);

        return view('projects.appeals')->with([
            'project' => $project,
            'members' => $group->members()->get(),
            'rejection' => $rejection,
            'appeals' => $rejection->appeals()->simplePaginate(20),
        ]);
    }

    protected function projectBelongsToUser(Project $project, Rejection $rejection)
    {
        return Auth::guard()->user()->getGuardType() === 'student'
            ? $project->group_id === Auth::guard()->user()->getGroupId()
            : $rejection->teacher_id === Auth::guard()->id();
    }

    protected function notify(Project $project, Rejection $rejection, Appeal $appeal)
    {
        $guard = Auth::guard()->user()->getGuardType();

        $deviceTokens = $guard === 'student'
            ? [Teacher::find($rejection->teacher_id)->device_token]
            : $this->groupService->getDeviceTokens($project->group()->first());

        $title = 'New ' . ($guard === 'student' ? 'Appeal' : 'Reply');
        $description = Auth::guard()->user()->name . " has " .
            ($guard === 'student' ? 'appealed' : 'replied') . " to " .
            ($guard === 'student' ? 'your' : 'their') . " rejection";

        $route = route('view.appeals', [$project, $rejection]) . '#appeal-' . $appeal->id;

        $this->notificationService->send($this->notificationService->prepare(
            $deviceTokens,
            $title,
            $description,
            Auth::guard()->user()->avatar(),
            $route,
        ));
    }
}
