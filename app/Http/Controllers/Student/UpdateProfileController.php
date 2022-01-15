<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentUpdateProfileRequest;

class UpdateProfileController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:student');
    }

    public function __invoke (StudentUpdateProfileRequest $request)
    {
        Auth::guard()->user()->update($request->validated());

        return redirect()->route('home');
    }
}
