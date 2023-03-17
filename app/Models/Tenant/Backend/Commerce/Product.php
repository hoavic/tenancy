<?php

namespace App\Models\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Item;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $table='products';
    protected $fillable=[

        'SKU',
        'supplier_product_id',

        'name',
        'description',
        'short_description',

        'status',
        'slug',
        'guid',
        'type',

        'price',
        'discount',
        'start_at',
        'end_at',

        'shop',
        'quantity',

        'brand_id',

        'meta_title',
        'meta_keywords',
        'meta_description',

        'is_publish',
        'published_at',

    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    //format updated_at data
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function getPublishedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->crop('crop-center', 150, 150);
        
        $this->addMediaConversion('medium')
            ->width(300)
            ->sharpen(10);
    }

    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'featured_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    //Relationship

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function items():HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function users() {
        return $this->hasMany(User::class); 
    }

    public function product_categories() {
        return $this->belongsToMany(ProductCategory::class, 'product_productcategory'); 
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id'); 
    }

/*     public function postMetas(): HasMany
    {
        return $this->hasMany(PostMeta::class);
    }

    public function postMetaValues(): HasMany
    {
        return $this->hasMany(PostMetaValue::class);
    } */
}
