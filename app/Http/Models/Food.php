<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'food_name', 'quantity', 'measure_type', 'energy_value', 'carbohydrates', 'sugars', 'proteins', 'fats', 'dietary_fiber', 'sodium', 'other', 'path_image', 'created_at', 'updated_at'
    ];

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'user_foods', 'food_id', 'user_id');
    }

    public function food_type(): HasOne {
        return $this->hasOne(FoodType::class, 'food_id', 'id');
    }

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'imageable');
    }

}
