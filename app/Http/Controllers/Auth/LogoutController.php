<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function __invoke (Request $request)
    {
        Auth::guard()->logout();

        return redirect('/');
    }
}
