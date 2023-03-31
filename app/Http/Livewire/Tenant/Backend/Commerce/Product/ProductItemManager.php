<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce\Product;

use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Inventory\Item;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ProductItemManager extends Component
{

    public Product $product;
    public $items;

    protected $rules = [
        'items.*.product_id'  => 'required|integer',
        'items.*.sku'  => 'nullable|string',
        'items.*.barcode'  => 'nullable|string',
        'items.*.price'  => 'required|min_digits:0',
        'items.*.quantity'  => 'required|min_digits:0',
    ];

    protected $listeners = ['refreshComponent' => '$refresh'];

/*     public function mount()
    {
        $this->items = Item::where('product_id', '=', $this->product->id)->get();
    } */

    public function save()
    {
        $this->validate();

        foreach ($this->items as $index => $item) {
            $this->validate([
                "items.$index.sku" => ['nullable', 'string', Rule::unique('items', 'sku')->ignoreModel($item)],
                "items.$index.barcode" => ['nullable', 'string', Rule::unique('items', 'barcode')->ignoreModel($item)]
            ], [
                "items.$index.name.unique" => 'Duplicated.'
            ]);
            
            $item->save();
        }
    }

    public function render()
    {
        return view('livewire..tenant.backend.commerce.product.product-item-manager');
    }
}
