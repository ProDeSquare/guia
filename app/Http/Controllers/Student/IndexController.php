<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:student');
        $this->middleware('student.added.email');
    }

    public function __invoke ()
    {
        return view('students.index');
    }
}
