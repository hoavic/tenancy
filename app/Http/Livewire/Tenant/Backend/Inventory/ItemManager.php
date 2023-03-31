<?php

namespace App\Http\Livewire\Tenant\Backend\Inventory;

use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Inventory\Item;
use App\Models\Tenant\Backend\Order;
use Livewire\Component;

class ItemManager extends Component
{
    public Product $product;
    public Item $item;
    public Order $order;
    public Item $itemBeingDeleted;
    /* public $locations; */
/*     public $suppliers; */
    public $supplier_id;
    public $location_id;
    public bool $confirmingItemDeletion = false;

    protected $rules = [
        'item.product_id'  => 'required|integer',
        'item.brand_id'  => 'required|integer',
        'item.order_id'  => 'required|integer',
        'item.supplier_id'  => 'required|integer',
        /* 'item.location_id'  => 'nullable|integer', */
        'item.SKU'  => 'nullable|string',

        'item.MRP'  => 'required|min_digits:0',
        'item.price'  => 'required|min_digits:0',
        'item.discount'  => 'required|min_digits:0',
        'item.quantity'  => 'required|min_digits:0',
    ];

    protected $listeners = ['setItemData'];

    public function mount()
    {
        $this->item = new Item();
/*         $this->suppliers = Supplier::all(); */
       /*  $this->locations = Location::all(); */
        $this->item->supplier_id = $this->supplier_id;
        $this->item->location_id = $this->location_id;
        $this->item->quantity = 1;
        $this->item->discount = 0;
    }

    public function updatedItemMRP()
    {
        if($this->item->MRP == null) {
            $this->item->discount = 0;
        }

        if($this->item->MRP == 0) {
            $this->item->price = $this->item->discount = $this->item->MRP;
        }
 
        $this->item->price = $this->item->MRP - $this->item->discount;

    }

    public function updatedItemDiscount()
    {
        if($this->item->discount == null) {
            $this->item->discount = 0;
        }

        if($this->item->discount > $this->item->MRP) {
            $this->item->MRP = $this->item->discount;
        }

        $this->item->price = $this->item->MRP - $this->item->discount;

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
        return view('livewire..tenant.backend.inventory.item-manager');
    }
}
