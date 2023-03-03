<?php

namespace App\Http\Livewire\Tenant\Backend\Product;

use App\Models\Tenant\Backend\Product\Product;
use App\Models\Tenant\Backend\Product\ProductCategory;
use Livewire\Component;

class CreateProduct extends Component
{

    public $submitLabel = "Đăng";

    public $product_categories;

    public $product_category_ids;

    public Product $product;
    

    public function mount()
    {
        $this->product_categories = ProductCategory::where('parent_id', '=', 0)->get();
        if (empty($this->product)) {
            $this->product = new Product();
            $this->product_category_ids = array(1);
        }
        
    }

    public function render()
    {
        return view('livewire..tenant.backend.product.create-product')->layout(\App\View\Components\TenAppLayout::class);
    }
}
