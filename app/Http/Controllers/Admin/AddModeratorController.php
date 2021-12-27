<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mod;
use App\Rules\FullNameRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AddModeratorController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin');
    }

    public function add (Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:25', new FullNameRule()],
            'email' => 'required|email|unique:admin',
            'password' => 'required|min:8|max:255'
        ]);

        Mod::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->intended('/admin/add/moderator?mod_added=true');
    }

    public function show ()
    {
        return view('admin/add-moderator');
    }
}
