<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejection extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'comment',
    ];

    public function teacher ()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
