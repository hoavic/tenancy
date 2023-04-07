<?php

namespace App\Models\Tenant\Backend\Commerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'attributes';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'group',
        'visual'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute_values(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }
}
