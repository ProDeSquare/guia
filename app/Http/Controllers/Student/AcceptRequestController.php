<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\NotificationModules\NotificationService;

class AcceptRequestController extends Controller
{
    protected $notificationService;

    public function __construct ()
    {
        $this->middleware('auth:student');
        $this->notificationService = new NotificationService();
    }

    public function __invoke (GroupMember $request)
    {
        if ($request->student_id !== Auth::guard()->id()) abort(404);

        if ($request->group()->first()->members()->count() >= 3) {
            $request->delete();
            return redirect()->back()->withFailure('Group has already reached max members!');
        }

        $this->sendNotifications($request->group()->first());

        $request->update([
            'accepted' => 1,
        ]);

        Auth::guard()->user()->groupRequests()->delete();

        return redirect()->route('home')->withSuccess('Successfully accepted group request!');
    }

    protected function sendNotifications (Group $group)
    {
        $FcmTokens = [];

        foreach ($group->members()->get() as $member) $FcmTokens[] = $member->student()->first()->device_token;

        $notification = new Request();
        $notification->setMethod('POST');
        $notification->request->add([
            'FcmToken' => $FcmTokens,
            'title' => 'Group Request',
            'description' => Auth::guard()->user()->name . " has accepted your group request.",
            'icon' => Auth::guard()->user()->avatar(),
        ]);

        $this->notificationService->send($notification);
    }
}
