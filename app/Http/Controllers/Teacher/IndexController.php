<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:teacher');
    }

    public function __invoke ()
    {
        return view('teachers.index');
    }
}
