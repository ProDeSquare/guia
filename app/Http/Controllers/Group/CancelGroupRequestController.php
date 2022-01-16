<?php

namespace App\Http\Controllers\Group;

use Auth;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CancelGroupRequestController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:student');
    }

    public function __invoke (Student $student)
    {
        if (Auth::guard()->id() === $student->id) abort(403);

        $student
            ->groupRequests()
            ->where('group_id', Auth::guard()->user()->group()->first()->group_id)
            ->delete();
        
        return redirect()->back()->withSuccess('Request Cancelled!');
    }
}
