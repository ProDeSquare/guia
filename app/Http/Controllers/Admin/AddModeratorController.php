<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Mod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DefaultRegisterRequest;

class AddModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(DefaultRegisterRequest $request)
    {
        Auth::guard('admin')->user()->moderators()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->intended('/admin/add/moderator');
    }

    public function show()
    {
        $mods = Mod::latest()->take(15)->get();

        return view('admin/add-moderator')->withMods($mods);
    }
}
