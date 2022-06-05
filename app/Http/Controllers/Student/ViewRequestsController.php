<?php

namespace App\Http\Controllers\Student;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
        $this->middleware('account.enabled');
    }

    public function __invoke()
    {
        return view('students.requests')
            ->withRequests(Auth::guard()->user()->groupRequests()->get());
    }
}
