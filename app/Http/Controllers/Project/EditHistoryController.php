<?php

namespace App\Http\Controllers\Project;

use App\Models\Group;
use App\Models\Project;
use App\Http\Controllers\Controller;

class EditHistoryController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->middleware('account.enabled');
    }

    public function __invoke (Project $project)
    {
        $group = Group::find($project->group_id);

        return view('projects.edit-history')->with([
            'project' => $project,
            'edits' => $project->edits()->latest()->simplePaginate(25),
            'members' => $group->members()->get(),
        ]);
    }
}
