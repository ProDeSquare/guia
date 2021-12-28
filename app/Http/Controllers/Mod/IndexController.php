<?php

namespace App\Http\Controllers\Mod;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:mod');
    }

    public function __invoke ()
    {
        return view('mods.index');
    }
}
