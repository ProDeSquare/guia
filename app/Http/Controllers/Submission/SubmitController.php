<?php

namespace App\Http\Controllers\Submission;

use App\Models\Project;
use App\Models\Milestone;
use App\Models\Assignment;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentCompletionRequest;

class SubmitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher,student');
    }

    public function __invoke(
                                AssignmentCompletionRequest $request,
                                Project $project,
                                Milestone $milestone,
                                Assignment $assignment
                            )
    {
        dd($request);
    }
}
