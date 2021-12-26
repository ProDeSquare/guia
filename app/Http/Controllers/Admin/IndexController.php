<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke ()
    {
        return view('welcome');
    }
}
