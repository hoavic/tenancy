<?php

namespace App\Models\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='orders';

    protected $fillable=[
        'customer_id',
        'type',
        'status',
        'status_update_by',
        'sub_total',
        'item_discount',
        'tax',
        'shipping',
        'total',
        'promo',
        'discount',
        'grand_total',

    ];

    public function getOrderItemCount()
    {
        return  $this->orderItems->count();
    }

    public function getTotalDiscount()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->discount;
        });
    }

    public function getTotalQuantity()
    {
        return $this->orderItems->sum(function ($orderItem) {
            return $orderItem->quantity;
        });
    }

    public function getTotalAmount()
    {
        return $this->orderItems->sum(function ($orderItem) {
            return $orderItem->amount();
        });
    }

    public function checkItemExists($id)
    {
        return OrderItem::where('item_id', '=', $id)->where('order_id', '=', $this->id)->first();
    }

    //relation

    public function orderItems():HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
