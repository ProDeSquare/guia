<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function add (Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|max:10240'
        ]);

        $name = time() . '.' . explode('/', $request->file)[2] . '_' . $request->file->getClientOriginalName();
        $path = $request->file->storeAs('uploads', $name, 'public');

        Auth::guard()->user()->uploads()->create([
            'guard' => Auth::guard()->user()->getGuardType(),
            'title' => $request->title,
            'file' => '/storage/' . $path,
        ]);

        return redirect()->route('file.upload')->withSuccess('File uploaded successfully');
    }

    public function show ()
    {
        return view('pages.files')->withUploads(Auth::guard()->user()->uploads()->latest()->simplePaginate(25));
    }
}
