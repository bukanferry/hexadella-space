<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DropellaBox extends Model
{
    protected $fillable = [
        'public_slug',
        'secret_key_hash',
        'title',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function files()
    {
        return $this->hasMany(DropellaFile::class);
    }
}
