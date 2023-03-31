<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce\Product;

use App\Models\Tenant\Backend\Commerce\Attribute;
use App\Models\Tenant\Backend\Commerce\AttributeValue;
use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Commerce\ProductAttribute;
use App\Models\Tenant\Backend\Commerce\ProductAttributeValue;
use App\Traits\Tenant\Backend\WithDeleteConfirm;
use App\Traits\Tenant\Backend\WithModal;
use Livewire\Component;

class ProductAttributeValueManager extends Component
{

    use WithModal, WithDeleteConfirm;

    public Product $product;
    public ProductAttribute $product_attribute;
    public ProductAttributeValue $product_attribute_value;
    
    public $values;
    public $selectedValues;

    public function mount()
    {
        $this->loadValues();
    }

    public function loadValues()
    {
        
        /* $allSelectedIds = Product::find($this->product->id)->attribute_values->pluck('id'); */
        
        $this->selectedValues = ProductAttributeValue::where('product_attribute_id', '=', $this->product_attribute->id)
                                                ->get();

        $this->values = AttributeValue::where('attribute_id', '=', $this->product_attribute->attribute->id)
                                        ->whereNotIn('id', $this->selectedValues->pluck('attribute_value_id'))
                                        ->get();
    }

    public function showValue() 
    {
        $this->showModal();
    }

    public function select($id)
    {
        if (empty($id)) {return;}


/* dd($this->product_attribute->id); */
        ProductAttributeValue::create([
            'product_id' => $this->product->id,
            'product_attribute_id'  => $this->product_attribute->id,
            'attribute_value_id'    => $id,
        ]);

        /* $this->product->attribute_values()->attach($id); */
        $this->loadValues();
    }

    public function delete() {
        /* dd($this->deleteId); */
        /* $this->product->attribute_values()->detach($this->deleteId); */
        $this->product_attribute_value = ProductAttributeValue::find($this->deleteId);
        $this->product_attribute_value->delete();
        $this->hideConfirmModal();
        $this->loadValues();
        $this->product_attribute_value = new ProductAttributeValue();
        session()->flash('success', 'Xóa thành công!');
    }

    public function render()
    {
        return view('livewire..tenant.backend.commerce.product.product-attribute-value-manager');
    }
}
