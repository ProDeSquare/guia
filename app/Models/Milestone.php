<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'github_issue_link'
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'milestone_id');
    }
}
