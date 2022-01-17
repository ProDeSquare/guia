<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Models\GroupMember;
use App\Http\Controllers\Controller;

class DeclineRequestController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:student');
    }

    public function __invoke (GroupMember $request)
    {
        if ($request->student_id !== Auth::guard()->id()) abort(404);

        $request->delete();

        return redirect()->route('requests.view');
    }
}
