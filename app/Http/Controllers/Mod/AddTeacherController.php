<?php

namespace App\Http\Controllers\Mod;

use Auth;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DefaultRegisterRequest;

class AddTeacherController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:mod');
    }

    public function add (DefaultRegisterRequest $request)
    {
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
