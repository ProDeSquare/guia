<?php

namespace App\Http\Controllers\Group;

use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeleteGroupController extends Controller
{
    protected $groupService;

    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function __invoke()
    {
        $group = Group::find(Auth::guard()->user()->getGroupId());

        if ($group->members()->count() > 1) return redirect()->route('student.profile', Auth::guard()->id());

        $group->members()->first()->delete();
        $group->projects()->delete();
        $group->delete();

        return redirect()->route('student.profile', Auth::guard()->id());
    }
}
