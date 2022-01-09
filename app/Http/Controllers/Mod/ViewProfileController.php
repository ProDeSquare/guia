<?php

namespace App\Http\Controllers\Mod;

use App\Models\Mod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewProfileController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function __invoke (Mod $mod)
    {
        return view('mods.profile')->withMod($mod);
    }
}
