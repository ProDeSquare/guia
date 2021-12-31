<?php

namespace App\Http\Controllers\Admin;

use Auth;
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
            'email' => 'required|email|unique:admin|unique:moderators|unique:teachers|unique:students',
            'password' => 'required|min:8|max:255'
        ]);

        Auth::guard('admin')->user()->moderators()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Mod::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        return redirect()->intended('/admin/add/moderator?mod_added=true');
    }

    public function show ()
    {
        $mods = Mod::latest()->take(15)->get();

        return view('admin/add-moderator')->withMods($mods);
    }
}
