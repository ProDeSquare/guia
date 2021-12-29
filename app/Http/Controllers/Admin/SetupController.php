<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Rules\FullNameRule;
use App\Models\Admin;

class SetupController extends Controller
{
    use AuthenticatesUsers;

    public function __construct ()
    {
        $this->middleware('admin.exists');
    }

    public function register (Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:25', new FullNameRule()],
            'email' => 'required|email|unique:admin|unique:moderators|unique:teachers|unique:students',
            'password' => 'required|min:8|max:255'
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->intended('/admin?setup=success');
    }

    public function show()
    {
        return view('admin.register');
    }
}
