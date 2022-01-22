<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:teacher');
    }

    public function __invoke ()
    {
        return view('teachers.settings')
            ->withTeacher(Auth::guard()->user());
    }
}
