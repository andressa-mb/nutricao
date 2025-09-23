<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ProfileEvolution extends Model
{
    protected $table = 'profile_evolutions';
    protected $fillable = [
        'profile_id', 'weight_current', 'metabolism_current', 'created_at', 'updated_at',
    ];

    public function profile(): BelongsTo {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'img');
    }

    public function getRecordedAtAttribute() {
      return $this->created_at->format('d/m/Y');
    }

}
