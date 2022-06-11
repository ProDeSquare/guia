<?php

namespace App\Http\Controllers\History;

use App\Models\Project;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    protected $projects;

    public function __invoke($year = null)
    {
        $this->setProjects($year);

        if (!$this->projects->count()) abort(404);

        return view('pages.project-history')->withProjects($this->projects)->withYear($year);
    }

    protected function setProjects($year)
    {
        if ($year) {
            $this->projects = Project::whereYear('created_at', $year)->where('status', 1)->latest()->simplePaginate(25);
            return;
        }

        $this->projects = Project::where('status', 1)->latest()->simplePaginate(25);
    }
}
