<?php

namespace App\Http\Controllers\Details;

use App\Models\Mod;
use App\Http\Controllers\Controller;

class ModeratorsController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod');
    }

    public function __invoke ()
    {
        $moderators = Mod::orderBy('created_at', 'desc')->simplePaginate(15);

        return view('pages.moderators')
            ->withModerators($moderators);
    }
}
