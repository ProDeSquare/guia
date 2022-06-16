<?php

namespace App\Http\Controllers\Faqs;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class GetController extends Controller
{
    public function __invoke()
    {
        return view('faqs.all')->with([
            'faqs' => Faq::latest()->simplePaginate(20),
        ]);
    }
}
