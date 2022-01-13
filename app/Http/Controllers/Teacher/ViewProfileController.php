<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewProfileController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->middleware('student.added.email');
    }

    public function __invoke (Teacher $teacher)
    {
        return view('teachers.profile')->withTeacher($teacher);
    }
}
