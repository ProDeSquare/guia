<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'accepted',
    ];

    public function group ()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function supervisor ()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
