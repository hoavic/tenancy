<?php

namespace App\Models\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Inventory\Item;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $table='products';
    
    protected $fillable=[

        'name',
        'description',
        'short_description',

        'status',
        'slug',
        'guid',
        'type',

/*         'price',
        'discount',
        'start_at',
        'end_at',

        'shop',
        'quantity', */

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

    //inventory

    public function getInventoryAmount()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity*$item->price;
        });
    }

    public function getTotalQuantity()
    {
        return $this->items->sum(function ($item) {
            return $item->getTotalQuantity();
        });
    }

    public function getTotalPurchaseAmount()
    {
        return $this->items->sum(function ($item) {
            return $item->getTotalPurchaseAmount();
        });
    }

    public function getInventorySold()
    {
        return $this->items->sum(function ($item) {
            return $item->sold;
        });
    }

    public function getInventory()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity - $item->sold;
        });
    }

    // Variant 

    public function generateVariant(array $input): array
    {
        if (! count($input)) return [];

        $result = [[]];
        $input = array_values($input);
        foreach ($input as $key => $values) {
            $append = [];
            foreach ($values as $value) {
                foreach ($result as $data) {
                    $append[] = $data + [$key => $value];
                }
            }
            $result = $append;
        }

        return $result;
    }

    public function saveVariant(array $variants)
    {
/*         $items = $this->items()->createMany(array_fill(0, count($variants), []));
    
        $variantOptions = [];
    
        foreach ($items as $index => $item) {
            foreach ($variants[$index] as $optionValue) {

                if($this->checkHasVariant($optionValue)) {continue; }

                $variantOptions[] = [
                    'product_id' => $this->id,
                    'item_id' => $item->id,
                    'product_attribute_id' => $optionValue['product_attribute_id'],
                    'attribute_value_id' => $optionValue['attribute_value_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        } */


        $variantOptions = [];

        foreach ($variants as $variant) {

            if($this->checkHasVariant($variant)) { continue; }
            /* if($this->checkHasVariant($variant, $this->currentVariants())) {dd($this->checkHasVariant($variant[1])); } */
 /*            dd($variant);
            break; */
            $item = $this->items()->create();

            foreach($variant as $optionValue) {
                
                $variantOptions[] = [
                    'product_id' => $this->id,
                    'item_id' => $item->id,
                    'product_attribute_id' => $optionValue['product_attribute_id'],
                    'attribute_value_id' => $optionValue['attribute_value_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

        }
        /* dd($variantOptions); */
        $this->variants()->insert($variantOptions);
    }

    // cheack value

    public function checkHasVariant($input) {
        /* dd($this->currentVariants()); */
        return in_array($input, $this->currentVariants());
/*         foreach ($this->currentVariants() as $item) {
            if ($input != $item) { dd($item);}
        } */
    }

    public function currentVariants()
    {
        $variants = Variant::select('item_id','product_attribute_id', 'attribute_value_id')
                            ->where('product_id', '=', $this->id)
                            ->get()
                            ->groupBy('item_id')
                            ->toArray();
        //Remove item_id
        foreach ($variants as $key => $variant) {
            foreach($variant as $i => $var) {
                /* dd($variants[$key][$i]['item_id']); */
                unset($variants[$key][$i]['item_id']); 
            }

            
        }

        return $variants;
    }
    

    //Relationship

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute', 'product_id', 'attribute_id');
    }

    public function attribute_values(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_value', 'product_id', 'attribute_value_id');
    }

    public function product_attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class, 'product_attribute');
    }

    public function product_attribute_values(): HasMany
    {
        return $this->hasMany(ProductAttributeValue::class, 'product_attribute_value');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function variants():HasMany
    {
        return $this->hasMany(Variant::class);
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

}
