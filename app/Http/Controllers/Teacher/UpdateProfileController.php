<?php

namespace App\Http\Controllers\Teacher;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherUpdateProfileRequest;

class UpdateProfileController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:teacher');
    }

    public function __invoke (TeacherUpdateProfileRequest $request)
    {
        Auth::guard()->user()->update($request->validated());

        return redirect()->back()->withSuccess('Profile Information Updated!');
    }
}
