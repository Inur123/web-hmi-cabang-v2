<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false; // non auto-increment
    protected $keyType = 'string'; // primary key string

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'status',
        'thumbnail',
        'content',
        'post_date',
        'view',
    ];



    // Otomatis generate slug ketika creating/updating
    protected static function booted()
    {
        static::saving(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

   public function galleries()
{
    return $this->hasMany(PostGallery::class);
}
}
