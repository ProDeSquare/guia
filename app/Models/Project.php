<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model implements Searchable
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

    public function milestones ()
    {
        return $this->hasMany(Milestone::class, 'project_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('project.view', $this->id);

        return new SearchResult(
            $this,
            $this->title,
            $url,
        ); 
    }

    public function edits ()
    {
        return $this->hasMany(ProjectEditHistory::class, 'project_id');
    }
}
