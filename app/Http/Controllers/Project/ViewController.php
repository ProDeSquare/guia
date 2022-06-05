<?php

namespace App\Http\Controllers\Project;

use App\Models\Group;
use App\Models\Project;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->middleware('account.enabled');
    }

    public function __invoke(Project $project)
    {
        $group = Group::find($project->group_id);

        return view('projects.index')->with([
            'project' => $project,
            'members' => $group->members()->get(),
            'rejections' => $project->rejections()->latest()->get(),
        ]);
    }
}
