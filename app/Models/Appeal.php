<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guard',
        'text',
    ];

    public function rejection()
    {
        return $this->belongsTo(Rejection::class, 'rejection_id');
    }
}
