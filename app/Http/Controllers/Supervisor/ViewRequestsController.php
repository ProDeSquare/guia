<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ViewRequestsController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:teacher');
    }

    public function __invoke ()
    {
        return view('teachers.requests')
            ->withRequests(Auth::guard()->user()->supervisionRequests()->get());
    }
}
