<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'url', 'img_id', 'img_parent', 'created_at', 'updated_at'
    ];

    public function imageable(): MorphTo {
        return $this->morphTo();
    }
}
