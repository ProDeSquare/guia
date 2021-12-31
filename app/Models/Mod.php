<?php

namespace App\Models;

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
        return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm";
    }

    public function teachers ()
    {
        return $this->hasMany(Teacher::class, 'created_by');
    }

    public function students ()
    {
        return $this->hasMany(Student::class, 'created_by');
    }
}