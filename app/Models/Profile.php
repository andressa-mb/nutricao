<?php

namespace App\Models;

use App\Models\ProfileHistory;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'user_id', 'weight', 'height', 'goal', 'metabolism', 'created_at', 'updated_at'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function evolutions(): HasMany {
        return $this->hasMany(ProfileEvolution::class, 'profile_id', 'id');
    }

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'img');
    }
}
