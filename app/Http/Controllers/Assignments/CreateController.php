<?php

namespace App\Http\Controllers\Assignments;

use App\Models\Project;
use App\Models\Milestone;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentsRequest;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function add(AssignmentsRequest $request, Project $project, Milestone $milestone)
    {
        if (!$project->group()->first()->isSupervisedBy(Auth::guard()->id())) abort(404);

        if (!$project->group()->first()->members()->where('student_id', $request->student_id)->count()) abort(404);

        $milestone->assignments()->firstOrCreate($request->validated());
    }

    public function show(Project $project, Milestone $milestone)
    {
        if (!$project->group()->first()->isSupervisedBy(Auth::guard()->id())) abort(404);

        return view('assignments.add')->with([
            'project' => $project,
            'members' => $project->group()->first()->members()->get(),
            'milestone' => $milestone,
        ]);
    }
}
