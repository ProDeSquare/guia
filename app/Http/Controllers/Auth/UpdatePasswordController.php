<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;

class UpdatePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function __invoke(UpdatePasswordRequest $request)
    {
        Auth::guard()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect('/' . Auth::guard()->user()->getGuardType() . '/account/settings')
            ->withSuccess('Password Updated Successfully!');
    }
}
