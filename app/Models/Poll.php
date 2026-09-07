<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'question', 'expires_at', 'total_votes'];
    
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function voters()
    {
        return $this->hasMany(PollVoter::class);
    }
}
