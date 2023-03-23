<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Commerce\Attribute;
use Livewire\Component;

class AttributeManager extends Component
{

    public Product $product;
    public Attribute $attribute;
    public bool $showCreateModal = false;
    public Attribute $attributeBeingDeleted;
    public bool $confirmingAttributeDeletion = false;

    protected $rules = [
        'attribute.visual' => 'required|string',
        'attribute.name' => 'required|string',
    ];

    protected $listeners = ['parentCreate'];

    public function createAttribute()
    {
        if(empty($this->product->id)) {
            $this->emitUp('storeProductAndPushToAttribute');
            session()->flash('warning', 'Nhập tên sản phẩm trước');
            return;
        }   
        /* dd($this->product->id); */
        $this->attribute = new Attribute();
        $this->showCreateModal = true;
    }

    public function parentCreate(Product $product)
    {
        $this->product = $product;
        $this->attribute = new Attribute();
        $this->showCreateModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->product->attributes()->save($this->attribute);
        $this->showCreateModal = false;
        $this->product->refresh();
    }

    public function confirmOptionDeletionFor(Attribute $attribute)
    {
        $this->confirmingAttributeDeletion = true;
        $this->attributeBeingDeleted = $attribute;
    }

    public function delete()
    {
        $this->attributeBeingDeleted->attribute_options()->delete();
        $this->attributeBeingDeleted->delete();
        $this->confirmingAttributeDeletion = false;
        $this->product->refresh();
    }

    public function render()
    {
        return view('livewire..tenant.backend.commerce.attribute-manager');
    }
}
