<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'name',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Returns only active
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
