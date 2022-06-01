<?php

namespace App\Http\Controllers\Milestones;

use App\Models\Project;
use App\Http\Controllers\Controller;

class GetMilestonesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->middleware('account.enabled');
    }

    public function __invoke(Project $project)
    {
        $milestones = $project->milestones()->with('assignments')->simplePaginate(5);

        return view('pages.milestones')->with([
            'milestones' => $milestones,
            'project' => $project,
        ]);
    }
}
