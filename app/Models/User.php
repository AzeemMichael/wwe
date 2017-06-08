<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdminUser(Builder $query) : Builder
    {
        return $query->whereHas('role', function (Builder $q) {
            $q->where('name', 'ROLE_ADMIN');
        });
    }

    /**
     * @param Builder $query
     * @param string $role
     * @return Builder
     */
    public function scopeHasRole(Builder $query, string $role) : Builder
    {
        return $query->whereHas('role', function (Builder $q) use ($role) {
            $q->where('name', $role);
        });
    }

    /**
     * @return BelongsTo
     */
    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return BelongsToMany
     */
    public function likedVideos() : BelongsToMany
    {
        return $this->belongsToMany(Video::class);
    }
}
