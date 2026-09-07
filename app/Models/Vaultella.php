<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaultella extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'file_path',
        'original_name',
        'mime_type',
        'size',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
