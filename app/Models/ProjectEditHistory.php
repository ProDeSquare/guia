<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEditHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'technologies',
        'description',
        'github_repo',
        'status',
        'title',
        'link',
    ];
}
