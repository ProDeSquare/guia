<?php

namespace App\Http\Controllers\Rejections;

use App\Models\Group;
use App\Models\Project;
use App\Models\Rejection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppealController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function add(Request $request, Project $project, Rejection $rejection)
    {
        $project->rejections()->findOrFail($rejection->id);

        if ($project->status === 1) abort(403);

        if (!$this->projectBelongsToUser($project, $rejection)) abort(404);

        $appeal = $rejection->appeals()->create([
            'user_id' => Auth::guard()->id(),
            'guard' => Auth::guard()->user()->getGuardType(),

            ...$request->validate([
                'text' => 'required',
            ]),
        ]);

        return redirect(route('view.appeals', [$project, $rejection]) . "#appeal-" . $appeal->id);
    }

    public function show(Project $project, Rejection $rejection)
    {
        $project->rejections()->findOrFail($rejection->id);

        $group = Group::find($project->group_id);

        return view('projects.appeals')->with([
            'project' => $project,
            'members' => $group->members()->get(),
            'rejection' => $rejection,
            'appeals' => $rejection->appeals()->paginate(20),
        ]);
    }

    protected function projectBelongsToUser(Project $project, Rejection $rejection)
    {
        return Auth::guard()->user()->getGuardType() === 'student'
            ? $project->group_id === Auth::guard()->user()->getGroupId()
            : $rejection->teacher_id === Auth::guard()->id();
    }
}
