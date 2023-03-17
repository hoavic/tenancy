<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Product;
use Livewire\Component;

class ShowProducts extends Component
{

    public $products;

    public function mount()
    {
        $this->products = Product::all();
        
    }

    public function render()
    {
        return view('livewire..tenant.backend.commerce.show-products')->layout(\App\View\Components\TenAppLayout::class);
    }
}
