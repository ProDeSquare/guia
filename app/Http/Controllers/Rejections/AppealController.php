<?php

namespace App\Http\Controllers\Rejections;

use App\Models\Group;
use App\Models\Project;
use App\Models\Rejection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppealController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function show(Project $project, Rejection $rejection)
    {
        $group = Group::find($project->group_id);

        return view('projects.appeals')->with([
            'project' => $project,
            'members' => $group->members()->get(),
            'rejection' => $rejection,
            'appeals' => $rejection->appeals()->paginate(20),
        ]);
    }
}
