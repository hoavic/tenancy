<?php

namespace App\Models\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Commerce\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'stocks';
    protected $fillable = ['location_id'];


    public function getTotalPurchaseQuantity()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->getTotalQuantity();
        });
    }

    public function getTotalSoldQuantity()
    {
        return $this->orders->sum(function ($order) {
            return $order->getTotalQuantity();
        });
    }

    public function getTotalPurchaseAmount()
    {
        return $this->purchases->sum(function ($purchase) {
            return $purchase->getTotalAmount();
        });
    }

    public function getTotalSoldAmount()
    {
        return $this->orderItems->sum(function ($orderItem) {
            return $orderItem->getTotalAmount();
        });
    }

    public function currentQuantity()
    {
        return ($this->getTotalPurchaseQuantity() - $this->getTotalSoldQuantity());
    }


    //Relation

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'item_stock', 'item_id'); 
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

/*     public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    } */
}
