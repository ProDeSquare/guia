<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddModeratorController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin');
    }

    public function add (Request $request)
    {
        // 
    }

    public function show ()
    {
        return view('admin/add-moderator');
    }
}
