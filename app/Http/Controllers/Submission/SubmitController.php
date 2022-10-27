<?php

namespace App\Http\Controllers\Submission;

use App\Models\Project;
use App\Models\Student;
use App\Models\Milestone;
use App\Models\Assignment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssignmentCompletionRequest;
use App\Modules\NotificationModules\NotificationService;

class SubmitController extends Controller
{
    protected $notificationService;
    protected $device_token;

    public function __construct()
    {
        $this->middleware('auth:teacher,student');
        $this->notificationService = new NotificationService();
    }

    public function __invoke(
                                AssignmentCompletionRequest $request,
                                Project $project,
                                Milestone $milestone,
                                Assignment $assignment
                            )
    {
        if ($assignment->is_completed) abort(403);

        $project->milestones()->findOrFail($milestone->id);
        $milestone->assignments()->findOrFail($assignment->id);

        if (
            (Auth::guard()->user()->getGuardType() === 'student' &&
            !Auth::guard()->user()->isAssigned($assignment)) ||
            (Auth::guard()->user()->getGuardType() === 'teacher' &&
            !$project->group()->first()->isSupervisedBy(Auth::guard()->id()))
        ) abort(403);

        $submission = $assignment->submissions()->create([
            'guard' => Auth::guard()->user()->getGuardType(),
            'submission' => $request->submission,
            'github_commit_link' => $request->github_commit_link,
        ]);

        $this->getUserDeviceToken($assignment, $project);

        $this->notify(route('assignment.view', [$project, $milestone, $assignment]) . '#submission-' . $submission->id);

        return redirect(route('assignment.view', [$project, $milestone, $assignment]) . '#submission-' . $submission->id);
    }

    protected function notify($route)
    {
        if (Auth::guard()->user()->getGuardType() === 'student') {
            $title = 'New Submission';
            $description = " has made a new submission";
        } else {
            $title = 'New Reply';
            $description = " has replied to your submission";
        }

        $this->notificationService->send($this->notificationService->prepare(
            [$this->device_token],
            $title,
            Auth::guard()->user()->name . $description,
            Auth::guard()->user()->avatar(),
            $route,
        ));
    }

    protected function getUserDeviceToken($assignment, $project)
    {
        $this->device_token = Auth::guard()->user()->getGuardType() === 'student'
            ? $project->group()->first()->supervisor()->first()->supervisor()->first()->device_token    
            : Student::find($assignment->student_id)->device_token;
    }
}
