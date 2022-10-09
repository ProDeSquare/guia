<?php

namespace App\Models;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mod extends Authenticatable
{
    use Notifiable;

    protected $guard = 'mod';

    protected $table = 'moderators';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function avatar ()
    {
        return $this->avatar ?? "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm";
    }

    public function teachers ()
    {
        return $this->hasMany(Teacher::class, 'created_by');
    }

    public function students ()
    {
        return $this->hasMany(Student::class, 'created_by');
    }

    public function getGuardType ()
    {
        return $this->guard;
    }

    public function owner ($id) : bool
    {
        return Auth::guard()->id() === $id;        
    }

    public function searchHistory ()
    {
        return $this->hasMany(Search::class, 'user_id')->where('guard', $this->guard);
    }
}