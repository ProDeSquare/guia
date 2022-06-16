<?php

namespace App\Http\Controllers\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;

class CreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function add(FaqRequest $request)
    {
        Faq::firstOrCreate($request->validated());

        return redirect()->route('faq.create')->withSuccess('Success');
    }

    public function show()
    {
        return view('faqs.create');
    }
}
