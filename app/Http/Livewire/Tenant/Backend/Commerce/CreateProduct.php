<?php

namespace App\Http\Livewire\Tenant\Backend\Commerce;

use App\Models\Tenant\Backend\Commerce\Brand;
use App\Models\Tenant\Backend\Commerce\Product;
use App\Models\Tenant\Backend\Commerce\ProductCategory;
use App\Models\Tenant\Backend\Inventory\Item;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateProduct extends Component
{

    public $submitLabel;

    public $product_categories;

    public $product_category_ids;

    public $brands;

    public $current_brand_ids;

    public Product $product;

    public Media $featured_image;

    public Item $item;

    public $items;

    protected $rules = [
/*         'product.SKU' => 'nullable|string',
        'product.supplier_product_id' => 'nullable|string', */

        'product.featured_id' => 'nullable|integer',
        'product.name' => 'required|string',
        'product.description' => 'nullable|string',
        'product.short_description' => 'nullable|string',

        'product.status' => 'nullable|string',
        'product.slug' => 'nullable|string',
        'product.type'  => 'required|string',

        'product.price' => 'nullable|integer|between:0,9999999999.99',
        'product.discount' => 'nullable|integer|between:0,9999999999.99',
        'product.start_at' => 'nullable|date:Y-m-d H:i:s',
        'product.end_at' => 'nullable|date:Y-m-d H:i:s',

        'product.shop' => 'nullable|string',
        'product.brand_id' => 'nullable|integer',
        'product.quantity' => 'nullable|integer',


        'product.meta_title' => 'nullable|string',
        'product.meta_keywords' => 'nullable|string',
        'product.meta_description' => 'nullable|string',

        'product.updated_at' => 'nullable|date:Y-m-d H:i:s',
        'product.is_publish' => 'boolean',
        'product.published_at' => 'nullable|date:Y-m-d H:i:s',

    ];

    protected $listeners = ['updateFeaturedByEmit', 'storeProductAndPushToAttribute'];
    

    public function mount(Request $request)
    {
        $this->product_categories = ProductCategory::where('parent_id', '=', 0)->get();

        $this->brands = Brand::all();

        $this->submitLabel = "Đăng";

        if($request->route('id')) {

            $this->product = Product::find($request->route('id'));

            $product_category_ids = array();

            foreach($this->product->product_categories as $product_category) {
                $product_category_ids[] = $product_category->id;
            }

            $this->product_category_ids = $product_category_ids;

            if(!empty($this->product->featured_id)) {
                $this->featured_image = Media::find($this->product->featured_id);
            }

            $this->submitLabel = "Cập nhật";
            
        }

        if (empty($this->product)) {
            $this->product = new Product();
            $this->product->is_publish = true;
            $this->product->status = 'public';
            $this->product->type = 'basic';
            $this->product->brand_id = 1;
            $this->product_category_ids = array(1);

            $this->items = array();
            
        }
        
    }

    public function updated($propertyName) {

        $this->validateOnly($propertyName);
    }

    public function updateFeaturedByEmit(Media $value) {
        $this->featured_image = $value;
        $this->product->featured_id = $this->featured_image->id;
    }

    public function storeProduct()
    {
        $this->validate();

        if(empty($this->product->user_id)) 
        {
            $this->product->user_id = Auth::id();
        }

/*         if(empty($this->product->slug)) 
        {
            $this->product->slug = SlugService::createSlug(Product::class, 'slug', $this->product->title);
        } */

        if(empty($this->product->guid)) 
        {
            $this->product->guid = tenant('domain').'\/product\/'.$this->product->slug;
        }

        try {

            $this->product->save();

            $this->product->product_categories()->sync($this->product_category_ids);
    
            session()->flash('success', $this->submitLabel.' sản phẩm thành công!');

            $this->submitLabel = "Cập nhật";

            $this->product->refresh();

        } catch (\Exception $ex) {

            session()->flash('error', $this->submitLabel.' sản phẩm không thành công.'.$ex);

        }

    }

    public function storeProductAndPushToAttribute() {
        $this->product->status = 'draft';
        $this->storeProduct();
        $this->emit('parentCreate', $this->product);
    }

    public function render()
    {
        return view('livewire..tenant.backend.commerce.create-product')->layout(\App\View\Components\TenAppLayout::class);
    }
}
