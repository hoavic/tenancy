<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table='coupencodes';
    protected $fillable=[
        'code',
        'validfrom',
        'validupto',
        'discount',
                   
        


    ];
}
