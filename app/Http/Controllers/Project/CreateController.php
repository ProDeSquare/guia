<?php

namespace App\Http\Controllers\Project;

use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProjectRequest;

class CreateController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:student');
    }

    public function add (ProjectRequest $request)
    {
        if (! Auth::guard()->user()->isGrouped()) abort(404);

        $group = Group::find(Auth::guard()->user()->getGroupId());

        $group->projects()->create($request->validated());

        return redirect()->route('view.group.projects', $group->id);
    }

    public function show ()
    {
        if (! Auth::guard()->user()->isGrouped()) return redirect('student.profile');

        return view('projects.add');
    }
}
