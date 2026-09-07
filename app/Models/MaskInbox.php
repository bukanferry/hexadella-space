<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaskInbox extends Model
{
    protected $fillable = ['public_slug', 'title', 'secret_token_hash', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function messages()
    {
        return $this->hasMany(MaskMessage::class);
    }
}
