<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'restaurant_id', 'status', 'total_amount', 'pickup_time'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('user_restaurants', function (\Illuminate\Database\Eloquent\Builder $builder) {
            if (auth()->check() && !auth()->user()->isAdmin()) {
                $builder->whereIn('restaurant_id', auth()->user()->restaurants->pluck('id'));
            }
        });
    }
}
