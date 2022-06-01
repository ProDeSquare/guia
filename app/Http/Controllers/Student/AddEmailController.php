<?php

namespace App\Http\Controllers\Student;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
        $this->middleware('account.enabled');
        $this->middleware('student.not.added.email');
    }

    public function add(Request $request)
    {
        Auth::guard()->user()->update($request->validate([
            'email' => 'required|email|unique:admin|unique:moderators|unique:teachers|unique:students'
        ]));

        return redirect()->route('student.profile', [
            'student' => Auth::guard()->id(),
        ]);
    }

    public function show()
    {
        return view('students.add-email');
    }
}
