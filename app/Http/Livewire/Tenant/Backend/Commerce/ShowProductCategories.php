<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\ProductCategory;
use Livewire\Component;
use Illuminate\Support\Str;

class ShowProductCategories extends Component
{
    public $product_category;
    public $product_categories;

    protected $rules = [
        'product_category.title'        => 'required|string|max:255',
        'product_category.slug'         => 'nullable|max:255',
        'product_category.description'  => 'nullable|text',
        'product_category.parent_id'    => 'nullable|integer',
    ];

    public function mount() {
        $this->loadProductCategories();
        $this->product_category = new ProductCategory();
        $this->product_category->parent_id = 0;
    }

    public function loadProductCategories()
    {
        $this->product_categories = ProductCategory::where('parent_id', '=', 0)->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save() 
    {
        $this->validate();
        try {
            if(empty($this->product_category->slug)) {
                $this->product_category->slug = $this->product_category->title;
            }
    
            $this->product_category->guid = tenant('id').'/'.$this->product_category->slug;
            $this->product_category->save();
            $this->loadProductCategories();
            session()->flash('success', 'Thanhf ccong');

        } catch (\Exception $ex) {
            session()->flash('error', 'Hieern thij xlooi'.$ex);
        }

    }

    public function delete($id) {
        ProductCategory::destroy($id);
        $this->loadProductCategories();
    }

    public function render()
    {
        return view('livewire..tenant.backend.commerce.show-product-categories')->layout(\App\View\Components\TenAppLayout::class);
    }
}
