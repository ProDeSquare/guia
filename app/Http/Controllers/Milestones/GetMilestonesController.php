<?php

namespace App\Http\Controllers\Milestones;

use App\Models\Project;
use App\Http\Controllers\Controller;

class GetMilestonesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function __invoke(Project $project)
    {
        $milestones = $project->milestones()->get();

        return view('milestones.index')->with([
            'milestones' => $milestones,
            'project' => $project,
        ]);
    }
}
