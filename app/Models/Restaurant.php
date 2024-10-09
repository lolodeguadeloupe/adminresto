<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'restaurant_type_id', 'name', 'description', 'address', 'phone', 'email'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurantType(): BelongsTo
    {
        return $this->belongsTo(RestaurantType::class);
    }

    public function menuCategories(): HasMany
    {
        return $this->hasMany(MenuCategory::class);
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function openingHours(): HasMany
    {
        return $this->hasMany(OpeningHour::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('user_restaurants', function (Builder $builder) {
            if (!auth()->user()->isAdmin()) {  // Si l'utilisateur est connecté
                if (auth()->check()) {
                    $builder->where('user_id', auth()->id());
                }
            }
        });
    }
}
