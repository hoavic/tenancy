<?php

namespace App\Models\Tenant;

use App\Models\Tenant\PostMetaValue;
use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable;

    protected $fillable = [
        'user_id',
        'content',
        'title',
        'excerpt',
        'status',
        'password',
        'slug',
        'parent',
        'guid',
        'menu_order',
        'type',
        'featured',
    ];

    //format created_at data
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }
    //format updated_at data
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'featured');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->crop('crop-center', 150, 150);
        
        $this->addMediaConversion('medium')
            ->width(300)
            ->sharpen(10);
    }

    public function users() {
        return $this->hasMany(User::class); 
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'posts_categories'); 
    }

    public function comments() {
        return $this->hasMany(Comment::class); 
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function postMetas(): HasMany
    {
        return $this->hasMany(PostMeta::class);
    }

    public function postMetaValues(): HasMany
    {
        return $this->hasMany(PostMetaValue::class);
    }

}
