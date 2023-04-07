<?php

namespace App\Models\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Inventory\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'logo',
        'field',
        'ranking',
        'contact_name',
        'contact_title',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'phone',
        'email',
        'website',
        'note',
    ];


    public function getTotalPurchaseQuantity()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->getTotalQuantity();
        });
    }

    public function getTotalPurchaseAmount()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->getTotalAmount();
        });
    }

/*     public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    } */

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'item_supplier', 'item_id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }


}
