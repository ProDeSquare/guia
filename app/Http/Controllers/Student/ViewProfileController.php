<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->middleware('student.added.email');
        $this->middleware('account.enabled');
    }

    public function __invoke(Student $student)
    {
        return view('students.profile')->withStudent($student);
    }
}
