<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __construct ()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:mod');
        $this->middleware('guest:teacher');
        $this->middleware('guest:student');
    }

    public function __invoke ()
    {
        return view('welcome');
    }
}
