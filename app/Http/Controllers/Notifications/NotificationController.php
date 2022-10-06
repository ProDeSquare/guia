<?php

namespace App\Http\Controllers\Notifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct ()
    {
        return $this->middleware('auth:teacher,student');
    }

    public function __invoke (Request $request)
    {
        Auth::guard()->user()->update([
            'device_token' => $request->token
        ]);

        return response()->json(['token saved successfully.']);
    }
}
