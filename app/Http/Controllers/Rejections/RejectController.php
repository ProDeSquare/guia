<?php

namespace App\Http\Controllers\Rejections;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RejectController extends Controller
{
    public function __construct ()
    {
        return $this->middleware('auth:teacher');
    }

    public function __invoke (Project $project, Request $request)
    {
        $group = $project->group()->first();

        if (! $group->requested(Auth::guard()->id())) abort(404);

        $request->validate([
            'comment' => 'required',
        ]);

        $project->rejections()->create([
            'comment' => $request->comment,
            'teacher_id' => Auth::guard()->id(),
        ]);

        $group->supervisorRequests()->where('teacher_id', Auth::guard()->id())->delete();

        return redirect()->back();
    }
}
