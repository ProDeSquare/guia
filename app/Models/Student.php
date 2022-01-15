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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar ()
    {
        return $this->email
            ? 'https://www.gravatar.com/avatar/' . md5($this->email) . '?d=mm'
            : 'http://www.gravatar.com/avatar/?d=mm';
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
        $url = route('student.profile', $this->id);

        return new SearchResult(
            $this,
            $this->username,
            $url,
        );
    }
}