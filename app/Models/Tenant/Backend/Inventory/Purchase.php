<?php

namespace App\Models\Tenant\Backend\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;


    public function getPurchaseItemCount()
    {
        return  $this->purchaseItems->count();
    }

    public function getTotalQuantity()
    {
        return  $this->purchaseItems->sum(function ($purchaseItem) {
            return $purchaseItem->quantity;
        });
    }

    public function getTotalAmount()
    {
        return $this->purchaseItems->sum(function ($purchaseItem) {
            return $purchaseItem->amount();
        });
    }



//realtion
    public function purchaseItems(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }

}
