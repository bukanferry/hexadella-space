<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HavenellaPost extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'content', 'fingerprint_hash', 'score', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function votes()
    {
        return $this->hasMany(HavenellaVote::class);
    }
}
