<?php

namespace App\Http\Controllers\Faqs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add()
    {
        // 
    }

    public function show()
    {
        return view('faqs.create');
    }
}
