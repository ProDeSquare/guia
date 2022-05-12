<?php

namespace App\Http\Controllers\Milestones;

use App\Models\Group;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MilestonesRequest;

class CreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function add(MilestonesRequest $request, Project $project)
    {
        if (!$this->projectIsAcceptedAndBelongsToUser($project)) abort(403);

        $milestone = $project->milestones()->firstOrCreate($request->validated());

        return redirect()->route('milestone.view', [$project, $milestone]);
    }

    public function show(Project $project)
    {
        if (!$this->projectIsAcceptedAndBelongsToUser($project)) abort(403);

        $group = Group::find($project->group_id);

        return view('milestones.add')->with([
            'project' => $project,
            'members' => $group->members()->get(),
        ]);
    }

    protected function projectIsAcceptedAndBelongsToUser(Project $project)
    {
        return Auth::guard()->user()->mainGroup()->acceptedProject()->id === $project->id;
    }
}
