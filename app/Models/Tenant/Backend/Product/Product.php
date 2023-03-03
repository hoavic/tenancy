<?php

namespace App\Models\Tenant\Backend\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model
{
    use HasFactory;

    protected $table='products';
    protected $fillable=[

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
        'featured',

        'rating',
        'price',
        'discount',
        'order_id',

        'title',
        'keywords',
        'meta_description',

    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    //format updated_at data
    public function getUpdatedAtAttribute($value)
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

    public function users() {
        return $this->hasMany(User::class); 
    }

    public function product_categories() {
        return $this->belongsToMany(ProductCategory::class, 'product_productcategory'); 
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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
