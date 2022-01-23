<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CancelRequestController extends Controller
{
    public function __construct ()
    {
        return $this->middleware('auth:student');
    }

    public function __invoke (Teacher $teacher)
    {
        $group = Auth::guard()->user()->mainGroup();

        $group->supervisorRequests()->where('teacher_id', $teacher->id)->delete();

        return redirect()->back();
    }
}
