<?php

namespace App\Http\Controllers\Assignments;

use App\Models\Project;
use App\Models\Milestone;
use App\Models\Assignment;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->middleware('account.enabled');
    }

    public function __invoke(Project $project, Milestone $milestone, Assignment $assignment)
    {
        $milestone = $project->milestones()->findOrFail($milestone->id);

        $assignment = $milestone->assignments()->findOrFail($assignment->id);

        $submissions = $assignment->submissions()->simplePaginate(20);

        return view('assignments.index')->with([
            'project' => $project,
            'milestone' => $milestone,
            'assignment' => $assignment,
            'submissions' => $submissions,
        ]);
    }
}
