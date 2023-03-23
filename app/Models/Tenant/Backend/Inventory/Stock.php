<?php

namespace App\Models\Tenant\Backend\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Stock extends Model
{
    use HasFactory;

    public function stock(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'item_stock', 'item_id'); 
    }

/*     public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    } */
}
