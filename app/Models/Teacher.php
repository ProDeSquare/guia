<?php

namespace App\Models;

use Auth;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable implements Searchable
{
    use Notifiable;

    protected $guard = 'teacher';

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'requirements',
        'bio',
        'whatsapp',
        'device_token',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function avatar ()
    {
        return $this->avatar ?? "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm";
    }

    public function createdBy ()
    {
        return $this->belongsTo(Mod::class, 'created_by')->first();
    }

    public function getGuardType ()
    {
        return $this->guard;
    }

    public function owner ($id) : bool
    {
        return Auth::guard()->id() === $id;        
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('teacher.profile', $this->id);

        return new SearchResult(
            $this,
            $this->name . ' - ' . $this->email,
            $url,
        );
    }

    public function searchHistory ()
    {
        return $this->hasMany(Search::class, 'user_id')->where('guard', $this->guard);
    }

    public function supervisionRequests ()
    {
        return $this->hasMany(Supervisor::class, 'teacher_id')->where('accepted', 0);
    }

    public function underSupervision ()
    {
        return $this->hasMany(Supervisor::class, 'teacher_id')->where('accepted', 1);
    }

    public function rejections ()
    {
        return $this->hasMany(Rejection::class, 'teacher_id');
    }

    public function uploads ()
    {
        return $this->hasMany(Upload::class, 'user_id')->where('guard', $this->guard);
    }
}