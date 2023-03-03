<?php

namespace App\Http\Livewire\Tenant\Backend\Product;

use Livewire\Component;

class ShowProducts extends Component
{
    public function render()
    {
        return view('livewire..tenant.backend.product.show-products')->layout(\App\View\Components\TenAppLayout::class);
    }
}
