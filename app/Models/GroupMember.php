<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'student_id',
        'accepted',
    ];

    public function group ()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function student ()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
