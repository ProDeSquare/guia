<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function add ()
    {
        // 
    }

    public function show ()
    {
        // 
    }
}
