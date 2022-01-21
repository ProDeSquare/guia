<?php

namespace App\Http\Controllers\Group;

use App\Models\Group;
use App\Http\Controllers\Controller;

class GetProjectsController extends Controller
{
    public function __construct ()
    {
        return $this->middleware('auth:admin,mod,teacher,student');
    }

    public function __invoke (Group $group)
    {
        return view('group.projects')->with([
            'projects' => $group->projects()->latest()->get(),
            'members' => $group->members()->get(),
        ]);
    }
}
