<?php

namespace App\Http\Models;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model {

    const admin = 'ADMIN';
    const standard = 'STANDARD';

    protected $table = 'roles';
    protected $fillable = [
        'role_name'
    ];

    public function users(): HasMany {
        return $this->hasMany(User::class, 'user_roles');
    }

    public function getRoleNameAttribute() {
        return $this->attributes['role_name'];
    }

    public function scopeStandard(Builder $b): Builder {
        return $b->where('role_name', static::standard);
    }

    public function scopeAdmin(Builder $b): Builder {
        return $b->where('role_name', static::admin);
    }

}
