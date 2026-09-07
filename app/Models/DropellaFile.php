<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DropellaFile extends Model
{
    protected $fillable = [
        'dropella_box_id',
        'original_name',
        'storage_path',
        'mime_type',
        'size',
    ];

    public function box()
    {
        return $this->belongsTo(DropellaBox::class, 'dropella_box_id');
    }
}
