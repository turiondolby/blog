<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'title',
        'body',
        'slug',
        'teaser',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public static function booted()
    {
        static::creating(function (Post $post) {
            $post->uuid = Str::uuid();

            if (! $post->slug) {
                $post->slug = $post->uuid;
            }
        });
    }
}
