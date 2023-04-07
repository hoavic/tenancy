<?php

namespace App\Models\Tenant\Backend\Commerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='coupencodes';
    protected $fillable=[
        'code',
        'validfrom',
        'validupto',
        'discount',
                   
        


    ];
}
