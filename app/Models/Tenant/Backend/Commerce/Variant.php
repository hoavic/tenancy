<?php

namespace App\Models\Tenant\Backend\Commerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Variant extends Model
{
    use HasFactory;

    protected $table = 'variants';

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
