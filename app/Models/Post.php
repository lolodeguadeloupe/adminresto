<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'thumbnail',
        'title',
        'color',
        'content',
        'tags',
        'slug',
        'published'
    ];

    protected $casts = [
        'tags' => 'array',
    ];
    
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function authors():BelongsToMany
    {
        return $this->BelongsToMany(User::class,'post_user')->withPivot(['order'])->withTimestamps();
    }
}
