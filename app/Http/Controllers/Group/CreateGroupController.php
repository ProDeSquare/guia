<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\GroupModules\GroupService;

class CreateGroupController extends Controller
{
    protected $groupService;

    public function __construct()
    {
        $this->middleware('auth:student');
        $this->groupService = new GroupService();
    }

    public function __invoke()
    {
        if (Auth::guard()->user()->isGrouped()) return redirect()->route('student.profile', Auth::guard()->id());

        $this->groupService->createNewGroupAndAddStudent();

        return redirect()->route('student.profile', Auth::guard()->id());
    }
}
