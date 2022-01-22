<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:student');
    }

    public function __invoke ()
    {
        return view('students.settings')
            ->withStudent(Auth::guard()->user());
    }
}
