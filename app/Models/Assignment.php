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
        'github_commit_link',
        'is_completed',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
