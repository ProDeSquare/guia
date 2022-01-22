<?php

namespace App\Http\Controllers\Mod;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:mod');
    }

    public function __invoke ()
    {
        return view('mods.settings')->withMod(Auth::guard()->user());
    }
}
