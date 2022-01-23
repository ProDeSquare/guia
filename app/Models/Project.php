<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
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

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function rejections ()
    {
        return $this->hasMany(Rejection::class, 'project_id');
    }
}
