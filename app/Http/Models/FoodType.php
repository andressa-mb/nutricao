<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodType extends Model
{
    protected $table = 'food_types';
    protected $fillable = [
        'food_id', 'group', 'food_type'
    ];

    public function food(): BelongsTo {
        return $this->belongsTo(Food::class, 'food_id', 'id');
    }
}
