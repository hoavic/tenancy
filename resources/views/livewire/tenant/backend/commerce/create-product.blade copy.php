<div>
    @livewireStyles
    <x-slot name="title">{{ $submitLabel }} Sản phẩm</x-slot>

    @include('tenant.backend.includes.error')
    @include('tenant.backend.includes.notification')
    
    <form wire:submit.prevent="storeProduct" class="relative">
        @csrf
        <div class="sticky top-8 p-4 h-14 bg-white text-right border-b border-gray-100">
            <button type="submit" id="save-product" class="py-2 px-4 bg-blue-600 text-gray-50">{{ $submitLabel }}</button>
        </div>

        <div class="create-grid">
            <div class="create-main">
                
                <x-box.default>
                    <input type="text" wire:model="product.name" id="name" name="name" class="w-full border-0 font-bold" placeholder="Tiêu đề (Tên sản phẩm)...">
                </x-box.default>


                <div class="my-4 p-2">
                    <p class="input-flex"><label for="is_publish">Hiển thị sản phẩm này:</label><input wire:model="product.is_publish" type="checkbox" name="is_publish" id="is_publish" /></p>
                    <p class="input-flex"><label for="SKU">SKU:</label><input wire:model="product.SKU" type="text" name="SKU" id="SKU" /></p>
                    <p class="input-flex"><label for="supplier_product_id">Mã sản phẩm (từ nhà cung cấp):</label><input wire:model="product.supplier_product_id" type="text" name="supplier_product_id" id="supplier_product_id" /></p>
                    <p class="input-flex"><label for="quantity">Kho hàng:</label><input wire:model="product.quantity" type="number" name="quantity" id="quantity" /></p>
                </div>

                {{-- Excerpt --}}
                <x-box.with-title>
                    <x-slot name="title">Viết mô tả rút gọn (tùy chọn)</x-slot>
                    <x-slot name="content">
                        <textarea wire:model.defer="product.short_description" id="short_description" class="w-full"
                        name="short_description"></textarea>
                    </x-slot>

                </x-box.with-title>

                <x-box.with-title>
                    <x-slot name="title">Thiết lập sản phẩm</x-slot>
                    <x-slot name="content">
                        <p class="input-flex">
                            <label for="price">Giá bán</label>
                            <input type="number" wire:model="product.price" id="price" name="price">
                        </p>
                        <p class="input-flex">
                            <label for="discount">Giá khuyến mãi</label>
                            <input type="number" wire:model="product.discount" id="discount" name="discount">
                        </p>
                        <p class="input-flex">
                            <label for="start_at">Bắt đầu</label>
                            <input type="datetime-local" wire:model.defer="product.start_at" id="start_at" name="start_at" />
                        </p>
                        <p class="input-flex">
                            <label for="end_at">Kết thúc</label>
                            <input type="datetime-local" wire:model.defer="product.end_at" id="end_at" name="end_at"/>
                        </p>
                    </x-slot>
                </x-box.with-title>
        
                <div class="my-4">
                    <label for="content">Mô tả sản phẩm</label>
                    <textarea class="mt-2 rounded w-full border border-gray-300 h-56" wire:model.defer="product.content" id="content" name="content"></textarea>
                </div>

                {{-- SEO --}}
                <x-box.with-title>
                    <x-slot name="title">Thiết lập SEO (tùy chọn)</x-slot>
                    <x-slot name="content">
                        <p class="input-flex">
                            <label for="meta_title">Tiêu đề</label>
                            <input type="text" wire:model.defer="product.meta_title" id="meta_title" name="meta_title"/>
                        </p>
                        <p class="input-flex">
                            <label for="meta_keywords">Từ khóa</label>
                            <input type="text" wire:model.defer="product.meta_keywords" id="meta_keywords" name="endmeta_keywords_at"/>
                        </p>
                        <label for="meta_description">Mô tả</label>
                        <textarea wire:model.defer="product.meta_description" id="meta_description" class="w-full"
                        name="meta_description"></textarea>
                    </x-slot>

                </x-box.with-title>

            </div>
            
            <div class="create-bar bg-white p-4">
    
                <div class="create-bar-block">
                    <span class="font-bold">Trạng thái và Hiển thị</span>
                    <div class="my-2 grid grid-cols-2 gap-4 items-center">
                        <label for="status" class="whitespace-nowrap">Trạng thái</label>
                        <select wire:model.defer="product.status" id="status" name="status" class="rounded w-full">
                            <option value="public">Công khai</option>
                            <option value="draft">Bản nháp</option>
                            <option value="pending">Chờ duyệt</option>
                        </select>
                    </div>
                    <div class="my-2 grid grid-cols-2 gap-4 items-center">
                        <label for="updated_at" class="whitespace-nowrap">Thời gian</label>
                        <input type="datetime-local" wire:model.defer="product.updated_at" id="updated_at" name="updated_at" class="rounded w-full" />
                    </div>
    
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
                                        <input id="cat{{ $brand->id }}" wire:model="current_brand_ids" class="brand_item rounded" type="checkbox" name="brand" value={{ $brand->id }} 
                            {{-- {{ dd($current_brand_ids) }} --}}
                                            @if (!empty($current_brand_ids))
                                                @foreach ($current_brand_ids as $current_brand_id)
                                                    @if ($current_brand_id === $brand->id)
                                                        checked
                                                    @endif
                                                @endforeach 
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
    
    </form>
    @livewireScripts
</div>
