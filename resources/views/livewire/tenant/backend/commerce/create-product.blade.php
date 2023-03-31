<div>

    <x-slot name="title">{{ $submitLabel }} Sản phẩm</x-slot>

    @include('tenant.backend.includes.error')
    @include('tenant.backend.includes.notification')
    
    <form wire:submit.prevent="storeProduct" class="relative">
        @csrf

        <div class="create-grid">
            <div class="create-main">
                
                <x-box.default>
                    <input type="text" wire:model="product.name" id="name" name="name" class="w-full border-0 font-bold" placeholder="Tiêu đề (Tên sản phẩm)...">
                </x-box.default>

                <div class="flex gap-4">
                    <x-button.text>Cơ bản</x-button.text>
                    <x-button.text>Nâng cao</x-button.text>
                    <x-button.text>SEO</x-button.text>
                </div>

                <x-form.row.input type="checkbox" wireKey="product.is_publish" key="is_publish" label="Hiển thị sản phẩm này:" row="flex"></x-form.row.input>

                {{-- Excerpt --}}
                <x-box.with-title>
                    <x-slot name="title">Mô tả sản phẩm</x-slot>
                    <x-slot name="content">
                        <textarea wire:model.defer="product.short_description" id="short_description" class="w-full"
                        name="short_description"></textarea>
                    </x-slot>

                </x-box.with-title>

                <x-form.row.select wireKey="product.type" key="type" label="Loại sản phẩm">
                    <option value="basic">Đơn giản</option>
                    <option value="has_attribute">Có thuộc tính</option>
                    {{-- <option value="has_variation">Có biến thể</option> --}}
                    <option value="affiliate">Liên kết ngoài</option>
                    <option value="download">Tải về</option>
                </x-form.row.select>

{{--                 @if ($product->type === 'basic')
                    @include('livewire.tenant.backend.commerce.create-product.basic')
                @endif --}}

                @if ($product->type === 'has_attribute')
                    {{-- @include('livewire.tenant.backend.commerce.create-product.has_attribute') --}}
                    {{-- {{ dd($product->attributes) }} --}}
                    @livewire('tenant.backend.commerce.product.product-attribute-manager', ['product' => $product])
                @endif 

                {{-- @livewire('tenant.backend.commerce.attribute-manager', ['product' => $product]) --}}

                @livewire('tenant.backend.commerce.product.product-item-manager', ['product' => $product, 'items' => $product->items])
        
                <div class="my-4">
                    <label for="content">Mô tả sản phẩm</label>
                    <textarea class="mt-2 rounded w-full border border-gray-300 h-56" wire:model.defer="product.content" id="content" name="content"></textarea>
                </div>

            </div>
            
            <div class="create-bar bg-white p-4">
    
                <div class="create-bar-block">

                    <span class="font-bold">Trạng thái và Hiển thị</span>

                    <x-form.row.select row="grid" wireKey="product.status" key="status" label="Trạng thái" blankoption=false>
                        <option value="public">Công khai</option>
                        <option value="draft">Bản nháp</option>
                        <option value="pending">Chờ duyệt</option>
                    </x-form.row.select>

                    @if ($submitLabel === "Cập nhật")
                        <x-form.row.input row="grid" type="datetime-local" wireKey="product.updated_at" key="updated_at" label="Thời gian" blankoption=false></x-form.row.input>
                    @endif

{{--                     <div class="my-2 grid grid-cols-2 gap-4 items-center">
                        <label for="updated_at" class="whitespace-nowrap">Thời gian</label>
                        <input type="datetime-local" wire:model.defer="product.updated_at" id="updated_at" name="updated_at" class="rounded w-full" />
                    </div> --}}
    
                </div>

                <div class="create-bar-block">

                    <label for="slug" class="font-bold text-gray-600">Đường dẫn</label>
                    <input type="text" wire:model.="product.slug" id="slug" name="slug" class="editor-slug" placeholder="Trống...">

                </div>
                
                {{-- Category --}}
                <div class="create-bar-block">
                    <span class="font-bold">Chuyên mục Sản phẩm</span>
                    <div class="my-2 py-2 max-h-32 overflow-auto">
                        
                        @if (!empty($product_categories))
    
                            @include('livewire.tenant.backend.commerce.update-product-category-select', ['product_categories' => $product_categories])
                        @else
                            <div class="pl-2"><span>chưa có danh mục nào!</span></div>    
                        @endif

                    </div>
                    <a href="{{ route('ten.product_categories.index') }}">Thêm chuyên mục</a>
                    <p>Varrexport: {{ var_export($product_category_ids) }}</p>
                </div>

                {{-- Brand --}}
                <div class="create-bar-block">
                    <span class="font-bold">Thương hiệu</span>
                    <div class="my-2 py-2 max-h-32 overflow-auto">
                        
                        @if (!empty($brands))
    
                            @foreach ($brands as $brand)

                                <div class="pl-2">
                                    <div class="my-2 flex gap-2 items-center">
                                        <input id="cat{{ $brand->id }}" wire:model="product.brand_id" class="brand_item rounded" type="checkbox" name="brand" value={{ $brand->id }} 
                                            
                                            @if ($product->brand_id === $brand->id || $product->brand_id === '$brand->id')
                                                checked
                                            @endif

                                        >
                                        <label for="cat{{ $brand->id }}">{{ $brand->title }}</label>
                                    </div>
                            
                                </div>

                                <script>
                                    function check(input)
                                    {

                                        var checkboxes = document.getElementsByClassName("brand_item");
                                        
                                        for(var i = 0; i < checkboxes.length; i++)
                                        {
                                            //uncheck all
                                            if(checkboxes[i].checked == true)
                                            {
                                                checkboxes[i].checked = false;
                                            }
                                        }
                                        
                                        //set checked of clicked object
                                        if(input.checked == true)
                                        {
                                            input.checked = false;
                                        }
                                        else
                                        {
                                            input.checked = true;
                                        }	
                                    }
                                </script>
                                
                            @endforeach

                        @else
                            <div class="pl-2"><span>chưa có thương hiệu nào!</span></div>
                        @endif

                    </div>
                    <a href="{{ route('ten.brands.index') }}">Thêm thương hiệu</a>
                </div>
    
                {{-- Tags --}}
                <div class="create-bar-block">
                    <span class="font-bold">Từ khóa</span>
                    <div class="my-2">
                        <label>Thêm từ khóa</label>
                        <input id="tags" class="" type="text" name="tags">
                    </div>
                    <p class="text-sm text-gray-400">Phân tách bởi dấu phẩy hoặc Enter</p>
                </div>
    
                {{-- Featured iamge --}}
                <div class="create-bar-block">
                    <span class="font-bold">Ảnh đại diện</span>
                    <input wire:model="product.featured_id" type="text" id="featured_id" name="featured_id" hidden/>
                    @if (!empty($product->featured_id))
                        
                        <div wire:click.prevent="$emit('openUpload')" class="editor-featured-image">
                            {{ $featured_image('thumbnail') }}
                        </div>

                        @livewire('tenant.backend.media-popup', ['featured' => $product->featured_id])
                    @else
                        <div wire:click.prevent="$emit('openUpload')" class="editor-featured-image">Click để tải file lên</div>
                        @livewire('tenant.backend.media-popup', ['featured' => ''])
                    @endif  
                    
                </div>
    
            </div>
        </div>
        <div class="app-sticky-submit"><x-button.primary type="submit" id="saveproduct">{{ $submitLabel }}</x-button.primary></div>
    </form>
</div>
