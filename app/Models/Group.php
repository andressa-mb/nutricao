<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    public $timestamps = false;
    protected $table = 'groups';
    protected $fillable = [
        'group_type'
    ];

    public function foods(): BelongsToMany {
        return $this->belongsToMany(Food::class, 'food_groups', 'group_id', 'food_id');
    }
}
