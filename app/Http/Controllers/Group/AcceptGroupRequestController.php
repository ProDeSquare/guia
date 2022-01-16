<?php

namespace App\Http\Controllers\Group;

use App\Models\GroupMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcceptGroupRequestController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:student');
    }

    public function __invoke (GroupMember $groupMemberRequest)
    {
        // 
    }
}
