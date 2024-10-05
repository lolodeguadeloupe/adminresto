<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpeningHour extends Model
{
    protected $fillable = ['restaurant_id', 'day_of_week', 'open_time', 'close_time'];

    protected $casts = [
        'day_of_week' => 'integer',
        'open_time' => 'datetime',
        'close_time' => 'datetime',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}
