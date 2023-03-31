<?php

namespace App\Models\Tenant\Backend\Commerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttributeValue extends Model
{
    use HasFactory;

    protected $table = 'product_attribute_value';

    protected $fillable = [
        'product_id',
        'product_attribute_id',
        'attribute_value_id',
    ];

    public $timestamps = false;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function product_attribute(): BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    public function attribute_value(): BelongsTo
    {
        return $this->belongsTo(AttributeValue::class);
    }

}
