<?php

namespace App\Models\Tenant\Backend\Commerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'productcategories';

    protected $fillable = [
        'title',
        'description',
        'parent_id',
        'slug',
        'guid',
    ];

/*     public static function resetActionsPerformed()
    {
        static::$actionsPerformed = 0;
    } */

    public function products() {
        return $this->belongsToMany(Product::class, 'product_productcategory');
    }

    public function parent() {
        return $this->hasOne(ProductCategory::class, 'id', 'parent_id');
    }

    public function children() {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
    }

}
