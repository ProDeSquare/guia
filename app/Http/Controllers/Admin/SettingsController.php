<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke ()
    {
        return view('admin.settings')->withAdmin(Auth::guard()->user());
    }
}
