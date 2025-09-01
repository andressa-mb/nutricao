<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    protected $table = 'people';
    protected $fillable = [
        'user_id', 'birthday_date', 'weight', 'height', 'goal', 'metabolism', 'created_at', 'updated_at'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
