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
    }

    public function __invoke(Project $project, Milestone $milestone)
    {
        $milestone = $project->milestones()->findOrFail($milestone->id);

        return view('milestones.index')->with([
            'project' => $project,
            'milestone' => $milestone,
        ]);
    }
}
