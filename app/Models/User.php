<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'egn',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    /**
     * Get the full user's name
     * @return Attribute
     */
    protected function fullName(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $this->first_name . ' ' . $this->last_name,
        );
    }

    /**
     * Returns user's appointments
     *
     * @returns HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(UserAppointment::class);
    }

    /**
     * Returns by EGN
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeByEGN(Builder $query, $egn): Builder
    {
        return $query->where('egn', $egn);
    }
}
