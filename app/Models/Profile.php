<?php

namespace App\Models;

use App\Models\ProfileHistory;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'user_id', 'birthday', 'weight', 'height', 'goal', 'metabolism', 'created_at', 'updated_at', 'deleted_at'
    ];

    protected $casts = [
        'birthday' => 'datetime',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function histories(): HasMany {
        return $this->hasMany(ProfileHistory::class, 'profile_id', 'id');
    }
}
