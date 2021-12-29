<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    protected $guard;

    protected $guards_list = [
        'admin',
        'mod',
        'teacher',
        'student',
    ];

    public function __invoke (Request $request)
    {
        $this->setGuardName();
        Auth::guard($this->guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function setGuardName ()
    {
        foreach ($this->guards_list as $guard) {
            Auth::guard($guard)->check() && $this->guard = $guard;
        }
    }
}
