<?php

namespace App\Http\Controllers\Admin;

use App\Rules\FullNameRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        dd($request);
    }

    public function show ()
    {
        return view('admin/add-moderator');
    }
}
