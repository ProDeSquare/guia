<?php

namespace App\Http\Controllers\Mod;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DefaultLoginRequest;
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

    public function login (DefaultLoginRequest $request)
    {
        if (Auth::guard('mod')->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->intended('/mod');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password'
        ]);
    }

    public function show ()
    {
        return view('mods.login');
    }
}
