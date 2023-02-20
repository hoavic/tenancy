<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'content',
        'title',
        'excerpt',
        'status',
        'password',
        'name',
        'parent',
        'guid',
        'menu_order',
        'type',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->crop('crop-center', 150, 150);
        
        $this->addMediaConversion('medium')
            ->width(300)
            ->sharpen(10);
    }

    public function featured_images() {
        return $this->hasOne(FeaturedImages::class);
    }

    public function users() {
        return $this->hasMany(User::class); 
    }

    public function categories() {
        return $this->belongsToMany(Category::class); 
    }

    public function comments() {
        return $this->hasMany(Comment::class); 
    }


}
