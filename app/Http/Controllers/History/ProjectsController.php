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

        dd($this->projects);
    }

    protected function setProjects($year)
    {
        if ($year) {
            $this->projects = Project::whereYear('created_at', $year)->simplePaginate(25);
            return;
        }

        $this->projects = Project::simplePaginate(25);
    }
}
