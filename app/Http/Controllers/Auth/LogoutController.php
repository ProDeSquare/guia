<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    protected $guard;

    public function __invoke (Request $request)
    {
        $this->getGuardName();

        Auth::guard($this->guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function getGuardName ()
    {
        if (Auth::guard('admin')->check()) $this->guard = 'admin';
    }
}
