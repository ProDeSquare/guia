<?php

namespace App\Http\Controllers\Assignments;

use App\Models\Project;
use App\Models\Student;
use App\Models\Milestone;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AssignmentsRequest;
use App\Modules\NotificationModules\NotificationService;

class CreateController extends Controller
{
    protected $notificationService;

    public function __construct()
    {
        $this->middleware('auth:teacher');
        $this->notificationService = new NotificationService();
    }

    public function add(AssignmentsRequest $request, Project $project, Milestone $milestone)
    {
        if (!$project->group()->first()->isSupervisedBy(Auth::guard()->id())) abort(404);

        if (!$project->group()->first()->members()->where('student_id', $request->student_id)->count()) abort(404);

        $milestone->assignments()->firstOrCreate($request->validated());

        $this->notificationService->send($this->notificationService->prepare(
            [Student::find($request->student_id)->device_token],
            'New Assignment',
            Auth::guard()->user()->name . " has assigned you a new assignment",
            Auth::guard()->user()->avatar(),
            route('dashboard'),
        ));

        return redirect()->route('milestone.view', [$project->id, $milestone->id]);
    }

    public function show(Project $project, Milestone $milestone)
    {
        if (!$project->group()->first()->isSupervisedBy(Auth::guard()->id())) abort(404);

        return view('assignments.add')->with([
            'project' => $project,
            'members' => $project->group()->first()->members()->get(),
            'milestone' => $milestone,
        ]);
    }
}
