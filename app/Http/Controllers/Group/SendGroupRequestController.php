<?php

namespace App\Http\Controllers\Group;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\GroupModules\GroupService;

class SendGroupRequestController extends Controller
{
    protected $groupService;

    public function __construct ()
    {
        $this->middleware('auth:student');
        $this->groupService = new GroupService();
    }

    public function __invoke (Student $student)
    {
        if (Auth::guard()->id() === $student->id) abort(403);

        if (! Auth::guard()->user()->isGrouped()) {
            $this->groupService->createNewGroupAndAddStudent();
        }

        else if ($this->groupService->groupExceedsMembersLimit(Auth::guard()->user()->group()->first()->group()->first())) {
            abort(403);
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
