<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Inventory\Location;
use App\Models\Tenant\Backend\Inventory\Supplier;
use App\Models\Tenant\Backend\Inventory\Item;
use Livewire\Component;

class ProductItem extends Component
{

    public Product $product;
    public $items = array();
    public Item $item;
    public Item $itemBeingDeleted;
    public $locations;
    public $suppliers;
    public bool $confirmingItemDeletion = false;

    protected $rules = [
        'item.product_id'  => 'required|integer',
        'item.brand_id'  => 'required|integer',
        'item.order_id'  => 'required|integer',
        'item.supplier_id'  => 'required|integer',
        'item.location_id'  => 'nullable|integer',
        'item.SKU'  => 'nullable|string',

        'item.MRP'  => 'required|min_digits:0',
        'item.price'  => 'required|min_digits:0',
        'item.quantity'  => 'required|min_digits:0',
    ];

    protected $listeners = ['setItemData'];

    public function mount()
    {
        $this->items = $this->product->items;
    }

    public function updatedItemPrice()
    {

        if($this->item->price == null) {
            $this->item->discount = 0;
        }

        if($this->item->price > $this->item->MRP) {
            $this->item->MRP = $this->item->price;
        }
        
        $this->item->discount = $this->item->MRP - $this->item->price;

    }

    public function setItemData()
    {
        /* dd($this->product); */
        $this->item->product_id = $this->product->id;
        $this->item->brand_id = $this->product->brand_id;
        $this->item->order_id = $this->order->id;
        $this->item->SKU = $this->product->SKU;

    }

    public function resetItemField()
    {
        $this->reset('item');
    }

    public function addItem()
    {
        $this->validate();
        $this->item->save();
        $this->emitUp('hideItemAdded');
    }

    public function render()
    {
        return view('livewire..tenant.backend.commerce.product-item');
    }
}
