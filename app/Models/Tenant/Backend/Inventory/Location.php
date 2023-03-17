<?php

namespace App\Models\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'address',
        'province',
        'district',
        'ward',
        'phone',
        'operating_time',
        'note',
    ];

    public function addressFull()
    {
        $ward = ($this->getAttribute('ward')->name ?? '').', ';
        $district = ($this->getAttribute('district')->name ?? '').', ';
        $province = ($this->getAttribute('province')->name ?? '');

        return $this->getAttribute('address').', '.$ward.$district.$province;
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

}
