<?php

namespace App\Http\Controllers\Mod;

use Auth;
use App\Models\Teacher;
use App\Rules\FullNameRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AddTeacherController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:mod');
    }

    public function add (Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:25', new FullNameRule()],
            'email' => 'required|email|unique:admin|unique:moderators|unique:teachers|unique:students',
            'password' => 'required|min:8|max:255',
        ]);

        Auth::guard('mod')->user()->teachers()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->intended('/mod/add/teacher?teacher_added=true');
    }

    public function show ()
    {
        $teachers = Teacher::latest()->take(15)->get();

        return view('mods.add-teacher')->withTeachers($teachers);
    }
}
