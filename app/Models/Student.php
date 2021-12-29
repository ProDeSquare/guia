<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
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
}