<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaskMessage extends Model
{
    protected $fillable = ['mask_inbox_id', 'content', 'fingerprint_hash'];

    public function inbox()
    {
        return $this->belongsTo(MaskInbox::class, 'mask_inbox_id');
    }
}
