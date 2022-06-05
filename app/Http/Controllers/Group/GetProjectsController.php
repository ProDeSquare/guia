<?php

namespace App\Http\Controllers\Group;

use App\Models\Group;
use App\Http\Controllers\Controller;

class GetProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->middleware('account.enabled');
    }

    public function __invoke(Group $group)
    {
        return view('group.projects')->with([
            'projects' => $group->projects()->orderBy('status', 'desc')->simplePaginate(5),
            'members' => $group->members()->get(),
        ]);
    }
}
