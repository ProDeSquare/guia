<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewProfileController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke (Admin $admin)
    {
        return view('admin.profile')->withAdmin($admin);
    }
}
