<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Models\GroupMember;
use App\Http\Controllers\Controller;

class AcceptRequestController extends Controller
{
    public function __construct ()
    {
        return $this->middleware('auth:student');
    }

    public function __invoke (GroupMember $request)
    {
        if ($request->student_id !== Auth::guard()->id()) abort(403);

        if ($request->group()->first()->members()->count() >= 3) {
            $request->delete();
            return redirect()->back()->withFailure('Group has already reached max members!');
        }

        $request->update([
            'accepted' => 1,
        ]);

        Auth::guard()->user()->groupRequests()->delete();

        return redirect()->route('home')->withSuccess('Successfully accepted group request!');
    }
}
