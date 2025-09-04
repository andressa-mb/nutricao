<?php

namespace App;

use App\Http\Models\Food;
use App\Http\Models\Image;
use App\Http\Models\Profile;
use App\Http\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): BelongsToMany {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    public function profile(): HasOne {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function foods(): BelongsToMany {
        return $this->belongsToMany(Food::class, 'user_foods', 'user_id', 'food_id');
    }

    public function image(): MorphOne {
        return $this->morphOne(Image::class, 'imageable');
    }

}
