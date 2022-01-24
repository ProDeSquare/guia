<?php

namespace App\Http\Controllers\Details;

use App\Models\Teacher;
use App\Http\Controllers\Controller;

class TeachersController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod');
    }

    public function __invoke ()
    {
        $teachers = Teacher::orderBy('created_at', 'desc')->simplePaginate(15);

        return view('pages.teachers')
            ->withTeachers($teachers);
    }
}
