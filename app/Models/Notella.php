<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notella extends Model
{
    protected $fillable = [
        'slug',
        'content',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
