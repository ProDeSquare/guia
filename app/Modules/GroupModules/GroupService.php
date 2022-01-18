<?php

namespace App\Modules\GroupModules;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class GroupService
{
    public function createNewGroupAndAddStudent()
    {
        $group = Group::create();

        Auth::guard()->user()->group()->create([
            'accepted' => 1,
            'group_id' => $group->id,
        ]);
    }

    public function groupExceedsMembersLimit(Group $group)
    {
        return $group->members()->count() >= 3;
    }
}