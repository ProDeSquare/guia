<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DefaultRegisterRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SetupController extends Controller
{
    use AuthenticatesUsers;

    public function __construct ()
    {
        $this->middleware('admin.exists');
    }

    public function register (DefaultRegisterRequest $request)
    {
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->intended('/admin/login?setup=success');
    }

    public function show()
    {
        return view('admin.register');
    }
}
