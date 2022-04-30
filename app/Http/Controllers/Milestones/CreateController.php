<?php

namespace App\Http\Controllers\Milestones;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function show(Project $project)
    {
        if (Auth::guard()->user()->mainGroup()->acceptedProject()->id !== $project->id) abort(403);

        $group = Group::find($project->group_id);

        return view('milestones.add')->with([
            'project' => $project,
            'members' => $group->members()->get(),
        ]);
    }
}
