<?php

namespace App\Models\Tenant\Backend\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $fillable=[
        'Customer_Emailid',
        'Delivery_Address',
        'Order_Details',
        'Amount',
        'paymentmode',
        'p_status',
        'p_status_Updated_By',
        'Coupen_Code',

    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
