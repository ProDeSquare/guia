<?php

namespace App\Http\Controllers\Assignments;

use App\Models\Project;
use App\Models\Student;
use App\Models\Milestone;
use App\Models\Assignment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\NotificationModules\NotificationService;

class MarkAsDoneController extends Controller
{
    protected $notificationService;

    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->notificationService = new NotificationService();
    }

    public function __invoke(Project $project, Milestone $milestone, Assignment $assignment)
    {
        $project->milestones()->findOrFail($milestone->id);

        $milestone->assignments()->findOrFail($assignment->id);

        $supervisor = $project->group()->first()->supervisor()->first()->supervisor()->first();

        if ($supervisor->id !== Auth::guard()->id()) abort(403);

        $assignment->update([
            'is_completed' => true,
        ]);

        $this->notificationService->send($this->notificationService->prepare(
            [Student::find($assignment->student_id)->device_token],
            'New Assignment Submission',
            Auth::guard()->user()->name . " has accepted your assignment",
            Auth::guard()->user()->avatar(),
            route('project.milestones', $project),
        ));

        return redirect()->route('assignment.view', [$project, $milestone, $assignment]);
    }
}
