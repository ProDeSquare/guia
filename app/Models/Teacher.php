<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function avatar ()
    {
        return "https://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm";
    }
}