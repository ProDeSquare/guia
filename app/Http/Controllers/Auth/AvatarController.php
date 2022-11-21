<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod,teacher,student');
        $this->middleware('account.enabled');
    }

    public function __invoke (Request $request)
    {
        Auth::guard()->user()->update($request->validate(['avatar' => 'nullable|url']));

        return redirect()->back()->withSuccess('Avatar updated successfully');
    }
}
