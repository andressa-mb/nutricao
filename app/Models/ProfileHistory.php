<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileHistory extends Model
{
    public $timestamps = false;
    protected $table = 'profile_histories';
    protected $fillable = [
        'profile_id', 'weight_prev', 'goal_prev', 'metabolism_prev', 'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];

    public function profile(): BelongsTo {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
