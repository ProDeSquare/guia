<?php

namespace App\Http\Controllers\Project;

use App\Models\Group;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;

class UpdateController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:student');
    }

    public function update (Project $project, ProjectRequest $request)
    {
        if (Auth::guard()->user()->getGroupId() !== $project->group_id) abort(404);
        if (Auth::guard()->user()->mainGroup()->supervisor()->count()) abort(404);

        $project->update($request->validated());

        return redirect()->route('project.view', $project->id);
    }

    public function show (Project $project)
    {
        if (Auth::guard()->user()->getGroupId() !== $project->group_id) abort(404);
        if (Auth::guard()->user()->mainGroup()->supervisor()->count()) abort(404);

        $group = Group::find(Auth::guard()->user()->getGroupId());

        return view('projects.update')->with([
            'project' => $project,
            'members' => $group->members()->get(),
        ]);
    }
}
