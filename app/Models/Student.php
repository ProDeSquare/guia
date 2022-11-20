<?php

namespace App\Models;

use Auth;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable implements Searchable
{
    use Notifiable;

    protected $guard = 'student';

    protected $table = 'students';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'group_id',
        'roll_no',
        'bio',
        'github',
        'enabled',
        'device_token',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createdBy()
    {
        return $this->belongsTo(Mod::class, 'created_by')->first();
    }

    public function avatar()
    {
        return $this->email
            ? $this->avatar ?? 'https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm'
            : 'http://www.gravatar.com/avatar/?d=mm';
    }

    public function getGuardType()
    {
        return $this->guard;
    }

    public function owner($id): bool
    {
        return Auth::guard()->id() === $id;
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('student.profile', $this->id);

        return new SearchResult(
            $this,
            $this->name . ' - ' . $this->roll_no,
            $url,
        );
    }

    public function searchHistory()
    {
        return $this->hasMany(Search::class, 'user_id')->where('guard', $this->guard);
    }

    public function group()
    {
        return $this->hasOne(GroupMember::class, 'student_id')->where('accepted', 1);
    }

    public function groupRequests()
    {
        return $this->hasMany(GroupMember::class, 'student_id')->where('accepted', 0);
    }

    public function hasAlreadyRequestedForCurrentGroup($id): bool
    {
        return $this->groupRequests()->where('group_id', $id)->count();
    }

    public function isGrouped(): bool
    {
        return $this->group()->count();
    }

    public function getGroupId()
    {
        return $this->group()->first()->group()->first()->id;
    }

    public function mainGroup()
    {
        return Group::find($this->getGroupId());
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'student_id');
    }

    public function isAssigned(Assignment $assignment): bool
    {
        return $this->assignments()->count()
            ? $this->assignments()->where('id', $assignment->id)->count()
            : false;
    }

    public function uploads ()
    {
        return $this->hasMany(Upload::class, 'user_id')->where('guard', $this->guard);
    }
}
