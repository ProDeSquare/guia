<?php

namespace App\Models;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $table = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function avatar ()
    {
        return $this->avatar ?? "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm";
    }

    public function moderators ()
    {
        return $this->hasMany(Mod::class, 'created_by');
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

    public function uploads ()
    {
        return $this->hasMany(Upload::class, 'user_id')->where('guard', $this->guard);
    }
}