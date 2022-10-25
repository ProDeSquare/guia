<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'student_id',
        'is_completed',
    ];

    public function milestone()
    {
        return $this->belongsTo(Milestone::class, 'milestone_id');
    }

    public function project()
    {
        return $this->milestone()->first()->project();
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
