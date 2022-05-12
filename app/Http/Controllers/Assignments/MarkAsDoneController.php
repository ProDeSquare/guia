<?php

namespace App\Http\Controllers\Assignments;

use App\Models\Project;
use App\Models\Milestone;
use App\Models\Assignment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssignmentCompletionRequest;

class MarkAsDoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function __invoke(AssignmentCompletionRequest $request, Project $project, Milestone $milestone, Assignment $assignment)
    {
        $project->milestones()->findOrFail($milestone->id);

        $milestone->assignments()->findOrFail($assignment->id);

        Auth::guard()->user()->assignments()->findOrFail($assignment->id)->update([
            'github_commit_link' => $request->github_commit_link,
            'is_completed' => true,
        ]);

        return redirect()->route('assignment.view', [$project, $milestone, $assignment]);
    }
}
