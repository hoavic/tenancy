<?php

namespace App\Models\Tenant\Backend;

use App\Models\Tenant\Backend\Commerce\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

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

    public function subTotalFormated()
    {
        return number_format($this->getAttribute('sub_total'),0,',','.');
    }

    public function items():HasMany
    {
        return $this->hasMany(Item::class);
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
