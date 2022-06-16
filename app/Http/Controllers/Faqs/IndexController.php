<?php

namespace App\Http\Controllers\Faqs;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class IndexController extends Controller
{
    public function __invoke(Faq $faq)
    {
        return view('faqs.index')->withFaq($faq);
    }
}
