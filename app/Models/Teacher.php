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
        'supervise_count',
        'co_supervise_count',
        'requirements',
        'bio',
        'whatsapp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function avatar ()
    {
        return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm";
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
            $this->name,
            $url,
        );
    }

    public function searchHistory ()
    {
        return $this->hasMany(Search::class, 'user_id')->where('guard', $this->guard);
    }
}