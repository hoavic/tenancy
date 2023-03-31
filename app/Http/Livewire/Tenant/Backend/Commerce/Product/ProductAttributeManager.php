<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce\Product;

use App\Models\Tenant\Backend\Commerce\Attribute;
use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Commerce\ProductAttribute;
use App\Models\Tenant\Backend\Commerce\ProductAttributeValue;
use App\Traits\Tenant\Backend\WithDeleteConfirm;
use App\Traits\Tenant\Backend\WithModal;
use Livewire\Component;
use Livewire\WithPagination;

class ProductAttributeManager extends Component
{

    use WithModal, WithDeleteConfirm, WithPagination;

    public $submitLabel;

    public Product $product;

    public $selectedAttributeIds;

    public $selectedProductAttributes;

    public ProductAttribute $pro_att_selected;

    protected $rules = [];

    public function mount() {
        $this->loadSelected();
    }

    public function loadSelected()
    {
        $this->selectedAttributeIds = Product::find($this->product->id)->attributes->pluck('id');
        $this->selectedProductAttributes = ProductAttribute::where('product_id', '=', $this->product->id)
                                                            ->whereIn('attribute_id', $this->selectedAttributeIds)
                                                            ->get();
        /* dd($this->selectedAttributes); */
    }

    public function select($id)
    {
        if (empty($id)) {return;}
        $this->product->attributes()->attach($id);
        $this->loadSelected();
    }

    public function create()
    {
        $variants = array();
        foreach($this->selectedProductAttributes as $variant)
        {
            $ids = $variant->product_attribute_values()->pluck('attribute_value_id');

            if($ids->count() != 0) {
                $variants[] = $ids;
            }

        }

        dd($this->combinations($variants));

    }

    public function combinations($arrays, $i = 0) {
        if (!isset($arrays[$i])) {
            return array();
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }
    
        // get combinations from subsequent arrays
        $tmp = $this->combinations($arrays, $i + 1);
    
        $result = array();
    
        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ? 
                    array_merge(array($v), $t) :
                    array($v, $t);
            }
        }
    
        return $result;
    }

    public function createItems()
    {
        $this->product->items()->delete();
        $this->updateItems();
    }

    public function updateItems()
    {

        $productAttributeValues = ProductAttributeValue::select('product_attribute_id','attribute_value_id')->where('product_id', '=', $this->product->id)->get()->groupBy('product_attribute_id')->toArray();
        /* dd($productAttributeValues); */
        $currentVariants = $this->product->currentVariants();

        if(!empty($currentVariants)) {
            if(count($productAttributeValues) != count($currentVariants[array_key_first($currentVariants)]))
            {
                session()->flash('success', 'Lỗi! Số thuộc tính có thay đổi.');
                return;
            }
        }

        $variants = $this->product->generateVariant($productAttributeValues);
        /* dd($variants); */
        $this->product->saveVariant($variants);

        $this->emit('refreshComponent');

    }

    public function delete() {
        /* dd($this->deleteId); */
        /* $this->product->attributes()->detach($this->deleteId); */
        $this->pro_att_selected = ProductAttribute::find($this->deleteId);
        $this->pro_att_selected->delete();
        $this->hideConfirmModal();
        $this->loadSelected();
        $this->pro_att_selected = new ProductAttribute();
        session()->flash('success', 'Xóa thành công!');
    }

    protected function validateMultiple($fields){
        foreach($fields as $field){
            $this->validateOnly( $field);
        }
    }

    public function render()
    {
        /* dd($collection->diff($this->selectedAttributes)); */
/*         $this->loadSelected(); */
        return view('livewire..tenant.backend.commerce.product.product-attribute-manager',[
            'attributes' => Attribute::whereNotIn('id', $this->selectedAttributeIds)->orderBy('name', 'asc')->paginate(5),
        ]);
    }
}
