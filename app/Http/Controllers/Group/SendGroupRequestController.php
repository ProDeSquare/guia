<?php

namespace App\Http\Controllers\Group;

use Auth;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SendGroupRequestController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:student');
    }

    public function __invoke (Student $student)
    {
        if (Auth::guard()->id() === $student->id) abort(403);

        if (! Auth::guard()->user()->isGrouped()) {
            $group = Group::create();

            Auth::guard()->user()->group()->create([
                'group_id' => $group->id,
                'accepted' => 1,
            ]);
        } else {
            if (Auth::guard()->user()->group()->first()->group()->first()->members()->count() >= 3) {
                abort(403);
            }
        }

        $group_id = Auth::guard()->user()->group()->first()->group_id;

        if ($student->isGrouped()) return redirect()->back();
        if ($student->hasAlreadyRequestedForCurrentGroup($group_id)) return redirect()->back();

        $student->group()->create([
            'group_id' => $group_id,
        ]);

        return redirect()->route('student.profile', $student->id)->withSuccess('Requested!');
    }
}
