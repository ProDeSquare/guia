<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEditHistory extends Model
{
    use HasFactory;

    protected $table = 'projects_edit_history';

    protected $fillable = [
        'technologies',
        'description',
        'github_repo',
        'status',
        'title',
        'link',
    ];

    public function project ()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
