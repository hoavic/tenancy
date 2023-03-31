<?php

namespace App\Models\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Commerce\Brand;
use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Commerce\Variant;
use App\Models\Tenant\Backend\Inventory\Location;
use App\Models\Tenant\Backend\Inventory\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    use HasFactory;


    public function getVariantNames()
    {
        $names = '';
        $vars = $this->variants;
        /* dd($vars); */
        foreach($vars as $var)
        {
            
            if(empty($var)) {return;}
            $comma = ', ';

            $value = $var->attribute_value->lable ?? $var->attribute_value->value;
            $names = $names.$var->product_attribute->attribute->name.': '.$value.$comma;
        }

        return $names;
    }

    public function getFullName()
    {
        return $this->product->name.' '.$this->getVariantNames();
    }

    public function getTotalQuantity()
    {
        return $this->purchaseItems->sum(function ($purchaseItem) {
            return $purchaseItem->quantity;
        });
    }

    public function getTotalPurchaseAmount()
    {
        return $this->purchaseItems->sum(function ($purchaseItem) {
            return $purchaseItem->amount();
        });
    }

    //Relation

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function purchaseItems(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }

}
