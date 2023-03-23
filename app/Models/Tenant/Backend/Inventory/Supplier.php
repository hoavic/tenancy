<?php

namespace App\Models\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Inventory\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

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

/*     public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    } */

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'item_supplier', 'item_id');
    }
}
