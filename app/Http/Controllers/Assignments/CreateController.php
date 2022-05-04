<?php

namespace App\Http\Controllers\Assignments;

use App\Models\Project;
use App\Models\Milestone;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function add()
    {
        // 
    }

    public function show(Project $project, Milestone $milestone)
    {
        return view('assignments.add')->with([
            'project' => $project,
            'members' => $project->group()->first()->members()->get(),
            'milestone' => $milestone,
        ]);
    }
}
