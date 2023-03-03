<div>
    <x-slot name="title">{{ $submitLabel }} Sản phẩm</x-slot>

    @if ($errors->any())
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif

    @if(session()->has('success'))
        <div class="p-4 m-4 block text-center bg-green-200 text-green-800 border border-green-600 rounded" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif

    <form wire:submit.prevent="storeProduct" method="POST" class="relative">
        @csrf
        <div class="sticky top-8 p-4 h-14 bg-white text-right border-b border-gray-100">
            <button type="submit" id="save-product" class="py-2 px-4 bg-blue-600 text-gray-50">{{ $submitLabel }}</button>
        </div>
    
        <div class="create-grid">
            <div class="create-main">
                <div class="editor-section">
                    <input type="text" wire:model="product.title" id="title" name="title" class="editor-title" placeholder="Tiêu đề...">
                </div>

                {{-- Excerpt --}}
                <div class="create-bar-block">
                    <div class="my-2">
                        <label for="excerpt">Viết mô tả rút gọn (tùy chọn)</label>
                        <textarea wire:model.defer="product.excerpt" id="excerpt" class="w-full"
                            name="excerpt"></textarea>
                    </div>
                </div>

                <x-box.with-title>
                    <x-slot name="title">Thiết lập giá cả</x-slot>
                    <x-slot name="content">
                        <div class="my-2">
                            <label for="price">Giá bán</label>
                            <input type="text" wire:model="product.price" id="price" name="price">
                        </div>
                        <div class="my-2">
                            <label for="discount">Giá khuyến mãi</label>
                            <input type="text" wire:model="product.discount" id="discount" name="discount">
                        </div>
                    </x-slot>
                </x-box.with-title>
        
                <div class="my-4">
                    <label for="content">Mô tả sản phẩm</label>
                    <textarea class="mt-2 rounded w-full border border-gray-300 h-56" wire:model.defer="product.content" id="content" name="content"></textarea>
                </div>

            </div>
            
            <div class="create-bar bg-white p-4">
    
                <div class="create-bar-block">
                    <span class="font-bold">Trạng thái và Hiển thị</span>
                    <div class="my-2 grid grid-cols-2 gap-4 items-center">
                        <label for="status" class="whitespace-nowrap">Trạng thái</label>
                        <select wire:model.defer="product.status" id="status" name="status" class="rounded w-full">
                            <option value="publish">Công khai</option>
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
    
                            @include('livewire.tenant.backend.product.update-product-category-select', ['product_categories' => $product_categories])
                            
                        @endif
                    </div>
                    <a href="{{ route('ten.product_categories.index') }}">Thêm chuyên mục</a>
                    <p>Varrexport: {{ var_export($product_category_ids) }}</p>
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
                    <input wire:model="product.featured" type="text" id="featured" name="featured" hidden/>
                    @if (!empty($product->featured))
                        <div wire:click.prevent="emit(openUpload())" class="editor-featured-image" style="background-image: url('{{ $product->featured['original_url'] }}')"></div>
                        @livewire('tenant.backend.media-popup', ['featured' => $product->featured])
                    @else
                        <div wire:click.prevent="emit(openUpload())" class="editor-featured-image">Click để tải file lên</div>
                        @livewire('tenant.backend.media-popup', ['featured' => ''])
                    @endif  
                    
                </div>
    
            </div>
        </div>
    
    </form>
</div>
