<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function members ()
    {
        return $this->hasMany(GroupMember::class, 'group_id')->where('accepted', 1);
    }

    public function projects ()
    {
        return $this->hasMany(Project::class, 'group_id');
    }
}
