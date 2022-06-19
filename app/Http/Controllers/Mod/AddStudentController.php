<?php

namespace App\Http\Controllers\Mod;

use Auth;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StudentRegisterRequest;

class AddStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:mod');
    }

    public function add(StudentRegisterRequest $request)
    {
        Auth::guard('mod')->user()->students()->create([
            'name' => $request->name,
            'username' => $request->username,
            'roll_no' => $request->roll_no,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->intended('/mod/add/student');
    }

    public function show()
    {
        $students = Student::latest()->take(15)->get();

        return view('mods.add-student')->withStudents($students);
    }
}
