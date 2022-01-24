<?php

namespace App\Http\Controllers\Details;

use App\Models\Student;
use App\Http\Controllers\Controller;

class StudentsController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod');
    }

    public function __invoke ()
    {
        $students = Student::orderBy('created_at', 'desc')->simplePaginate(15);

        return view('pages.students')
            ->withStudents($students);
    }
}
