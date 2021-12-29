<?php

namespace App\Http\Controllers\Teacher;

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
            'email' => 'required',
            'password' => 'required',
        ]);

        if (
            Auth::guard('teacher')
                ->attempt(
                    [
                        'email' => $request->email,
                        'password' => $request->password,
                    ],
                    $request->remember
                )
        ) {
            return redirect()->intended('/teacher');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password'
        ]);
    }

    public function show ()
    {
        return view('teachers.login');
    }
}
