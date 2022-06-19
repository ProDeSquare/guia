<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Group;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AcceptRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function __invoke(Group $group, Project $project)
    {
        $group->supervisorRequests()->where('teacher_id', Auth::guard()->id())->update([
            'accepted' => 1,
        ]) && $project->update([
            'status' => 1,
        ]);

        $group->supervisorRequests()->delete();

        return redirect()->route('view.group.projects', $group);
    }
}
