<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAppointment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'time',
        'description',
        'notified_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'time' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Returns appointment user
     *
     * @returns BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Returns appointment payment method
     *
     * @returns BelongsTo
     */
    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Returns only notified appointments
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyNotified(Builder $query): Builder
    {
        return $query->whereNotNull('notified_at');
    }
}
