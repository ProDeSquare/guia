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

    public function pending ()
    {
        return $this->hasMany(GroupMember::class, 'group_id')->where('accepted', 0);
    }

    public function projects ()
    {
        return $this->hasMany(Project::class, 'group_id');
    }

    public function acceptedProject ()
    {
        return $this->projects()->where('status', 1)->first();
    }

    public function supervisorRequests ()
    {
        return $this->hasMany(Supervisor::class, 'group_id')->where('accepted', 0);
    }

    public function requested ($id): bool
    {
        return $this->supervisorRequests()->where('teacher_id', $id)->count();
    }

    public function supervisor ()
    {
        return $this->hasOne(Supervisor::class, 'group_id')->where('accepted', 1);
    }

    public function isSupervisedBy ($id): bool
    {
        return $this->supervisor()->where('teacher_id', $id)->count();
    }
}
