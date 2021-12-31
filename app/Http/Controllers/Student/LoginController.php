<?php

namespace App\Http\Controllers\Student;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function __construct ()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:mod');
        $this->middleware('guest:teacher');
        $this->middleware('guest:student');
    }

    public function login (Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (
            Auth::guard('student')
                ->attempt(
                    [
                        'username' => $request->username,
                        'password' => $request->password,
                    ],
                    $request->remember
                )
        ) {
            if (Auth::guard('student')->user()->enabled) return redirect()->intended('/student');

            Auth::guard('student')->logout();

            return back()->withErrors([
                'username' => 'Your account has been blocked by your moderator'
            ]);
        }

        return back()->withErrors([
            'username' => 'Invalid username or password'
        ]);
    }

    public function show ()
    {
        return view('students.login');
    }
}
