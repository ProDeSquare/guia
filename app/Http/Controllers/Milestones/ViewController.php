<?php

namespace App\Http\Controllers\Milestones;

use App\Models\Project;
use App\Models\Milestone;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->middleware('account.enabled');
    }

    public function __invoke(Project $project, Milestone $milestone)
    {
        $project->milestones()->findOrFail($milestone->id);

        $assignments = $milestone->assignments()->get();

        return view('milestones.index')->with([
            'project' => $project,
            'milestone' => $milestone,
            'assignments' => $assignments,
        ]);
    }
}
