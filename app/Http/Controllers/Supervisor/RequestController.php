<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function __construct ()
    {
        return $this->middleware('auth:student');
    }

    public function __invoke (Teacher $teacher)
    {
        $group = Auth::guard()->user()->mainGroup();
        
        if (! $group->requested($teacher->id)) {
            $group->supervisorRequests()->create([
                'teacher_id' => $teacher->id,
            ]);
        }

        return redirect()->back();
    }
}
