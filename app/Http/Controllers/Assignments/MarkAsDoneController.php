<?php

namespace App\Http\Controllers\Assignments;

use App\Models\Project;
use App\Models\Teacher;
use App\Models\Milestone;
use App\Models\Assignment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssignmentCompletionRequest;
use App\Modules\NotificationModules\NotificationService;

class MarkAsDoneController extends Controller
{
    protected $notificationService;

    public function __construct()
    {
        $this->middleware('auth:student');
        $this->notificationService = new NotificationService();
    }

    public function __invoke(AssignmentCompletionRequest $request, Project $project, Milestone $milestone, Assignment $assignment)
    {
        $project->milestones()->findOrFail($milestone->id);

        $milestone->assignments()->findOrFail($assignment->id);

        Auth::guard()->user()->assignments()->findOrFail($assignment->id)->update([
            'github_commit_link' => $request->github_commit_link,
            'is_completed' => true,
        ]);

        $teacher = Teacher::find($project->group()->first()->supervisor()->first()->teacher_id);

        $this->notificationService->send($this->notificationService->prepare(
            [$teacher->device_token],
            'New Assignment Submission',
            Auth::guard()->user()->name . " has marked the assginment as complete",
            Auth::guard()->user()->avatar(),
            route('project.milestones', $project),
        ));

        return redirect()->route('assignment.view', [$project, $milestone, $assignment]);
    }
}
