<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Brand;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BrandManager extends Component
{
    public $brand;
    public $brands;
    public Media $logo;

    protected $rules = [
        'brand.title'        => 'required|string|max:255',
        'brand.slug'         => 'nullable|max:255',
        'brand.description'  => 'nullable|text',
        'brand.featured'     => 'nullable|integer',
        'logo'                 => 'nullable',
    ];

    protected $listeners = ['updateFeaturedByEmit'];

    public function mount() {
        $this->loadBrands();
        $this->brand = new Brand();
        $this->brand->parent_id = 0;
    }

    public function loadBrands()
    {
        $this->brands = Brand::get();
    }

    public function updateFeaturedByEmit(Media $value) {
        $this->logo = $value;
        $this->brand->featured = $this->logo->id;
    }

/*     public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    } */

    public function delete($id) {
        Brand::destroy($id);
        $this->loadBrands();
    }

    public function create() {
        $this->save();
        $this->brand = new Brand();
        $this->brand->parent_id = 0;
    }

    public function save() 
    {
        $this->validate();
        try {
            if(empty($this->brand->slug)) {
                $this->brand->slug = $this->brand->title;
            }
    
            $this->brand->guid = tenant('id').'/'.$this->brand->slug;
            $this->brand->save();
            $this->loadBrands();
            session()->flash('success', 'Thành công');

        } catch (\Exception $ex) {
            session()->flash('error', 'Hieern thij xlooi'.$ex);
        }

    }

    public function render()
    {
        return view('livewire.tenant.backend.commerce.show-brands')->layout(\App\View\Components\TenAppLayout::class);
    }
}
