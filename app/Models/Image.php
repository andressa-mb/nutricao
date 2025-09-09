<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'url', 'img_id', 'img_type', 'created_at', 'updated_at'
    ];

    public function img(): MorphTo {
        return $this->morphTo();
    }
}
