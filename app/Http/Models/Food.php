<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'food_name', 'value_per', 'unit_type', 'serving_size', 'calories', 'group', 'food_type', 'path_image', 'created_at', 'updated_at'
    ];

}
