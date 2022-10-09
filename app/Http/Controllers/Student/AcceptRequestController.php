<?php

namespace App\Http\Controllers\Student;

use App\Models\GroupMember;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\GroupModules\GroupService;
use App\Modules\NotificationModules\NotificationService;

class AcceptRequestController extends Controller
{
    protected $groupService;
    protected $notificationService;

    public function __construct ()
    {
        $this->middleware('auth:student');
        $this->groupService = new GroupService();
        $this->notificationService = new NotificationService();
    }

    public function __invoke (GroupMember $request)
    {
        if ($request->student_id !== Auth::guard()->id()) abort(404);

        if ($request->group()->first()->members()->count() >= 3) {
            $request->delete();
            return redirect()->back()->withFailure('Group has already reached max members!');
        }

        $this->notificationService->send($this->notificationService->prepare(
            $this->groupService->getDeviceTokens($request->group()->first()),
            'Group Request Accepted',
            Auth::guard()->user()->name . " has accepted your group request.",
            Auth::guard()->user()->avatar(),
            route('view.group.projects', $request->group()->first()),
        ));

        $request->update([
            'accepted' => 1,
        ]);

        Auth::guard()->user()->groupRequests()->delete();

        return redirect()->route('home')->withSuccess('Successfully accepted group request!');
    }
}
