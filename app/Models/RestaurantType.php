<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table='restaurant_types';

    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class);
    }
}
