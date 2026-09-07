<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HavenellaVote extends Model
{
    protected $fillable = ['havenella_post_id', 'fingerprint_hash', 'type'];

    public function post()
    {
        return $this->belongsTo(HavenellaPost::class, 'havenella_post_id');
    }
}
