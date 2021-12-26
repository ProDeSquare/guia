<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function __construct ()
    {
        $this->middleware('guest');
    }

    public function __invoke (Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (
            Auth::guard('admin')
                ->attempt(
                    [
                        'email' => $request->email,
                        'password' => $request->password,
                    ],
                    $request->remember
                )
        ) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password'
        ]);
    }
}
