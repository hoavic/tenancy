<?php

namespace App\Models\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Inventory\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "order_items";
    protected $fillable = [
        'order_id',
        'item_id',
        'price',
        'discount',
        'quantity',
        'note'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function amount()
    {
        return $this->price*$this->quantity;
    }
}
