<?php

namespace App\Http\Controllers\Mod;

use App\Models\Student;
use App\Rules\FullNameRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AddStudentController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:mod');
    }

    public function add (Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:25', new FullNameRule()],
            'username' => 'required|unique:students|min:3|max:25|alpha_dash',
            'roll_no' => 'required|integer',
            'password' => 'required|min:8|max:255'
        ]);

        Student::create([
            'name' => $request->name,
            'username' => $request->username,
            'roll_no' => $request->roll_no,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->intended('/mod/add/student?student_added=true');
    }

    public function show ()
    {
        $students = Student::latest()->take(15)->get();

        return view('mods.add-student')->withStudents($students);
    }
}
