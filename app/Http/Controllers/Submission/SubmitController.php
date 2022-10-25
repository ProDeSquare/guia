<?php

namespace App\Http\Controllers\Submission;

use App\Models\Project;
use App\Models\Milestone;
use App\Models\Assignment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssignmentCompletionRequest;

class SubmitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher,student');
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

        $assignment->submissions()->create([
            'user_id' => Auth::guard()->id(),
            'guard' => Auth::guard()->user()->getGuardType(),
            'submission' => $request->submission,
            'github_commit_link' => $request->github_commit_link,
        ]);

        return redirect()->route('assignment.view', [$project, $milestone, $assignment]);
    }
}
