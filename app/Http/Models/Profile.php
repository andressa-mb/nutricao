<?php

namespace App\Http\Models;

use App\Http\Models\ProfileHistory;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;
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
