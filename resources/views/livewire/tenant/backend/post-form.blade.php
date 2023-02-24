<div>

    @if ($errors->any())
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif

    <form wire:submit.prevent="storePost" method="POST" class="relative">
        @csrf
        <div class="sticky top-8 p-4 h-14 bg-white text-right border-b border-gray-100">
            <button type="submit" class="py-2 px-4 bg-blue-600 text-gray-50">Đăng</button>
        </div>
    
        <div class="create-grid">
            <div class="create-main">
                <div class="my-4">
                    <label for="title" class="text-gray-600">Tiêu đề</label>
                    <input type="text" wire:model="title" id="title" name="title" class="mt-2 rounded w-full border border-gray-300">
                </div>
                <div class="my-4">
                    <label for="name" class="text-gray-600">Slug</label>
                    <input type="text" wire:model="name" id="name" name="name" class="mt-2 rounded w-full border border-gray-300">
                </div>
        
                <div class="my-4">
                    <label for="name" class="text-gray-600">Nội dung</label>
                    <textarea class="mt-2 rounded w-full border border-gray-300 h-56" wire:model="content" id="content" name="content" hidden></textarea>
                </div>
    
                <div>
                    <div id="myeditor"></div>
                    <a href="#" class="" id="save-post">Save</a>
                </div>
            </div>
            
            <div class="create-bar bg-white p-4">
    
                <div class="create-bar-block">
                    <span class="font-bold">Trạng thái và Hiển thị</span>
                    <div class="my-2 grid grid-cols-2 gap-4 items-center">
                        <label for="status" class="whitespace-nowrap">Trạng thái</label>
                        <select wire:model="status" id="status" name="status" class="rounded w-full">
                            <option value="publish">Công khai</option>
                            <option value="draft">Bản nháp</option>
                            <option value="pending">Chờ duyệt</option>
                        </select>
                    </div>
                    <div class="my-2 grid grid-cols-2 gap-4 items-center">
                        <label for="created_at" class="whitespace-nowrap">Đăng</label>
                        <select id="created_at" name="created_at" class="rounded w-full">
                            <option value="now">ngay</option>
                            <option value="time">lên lịch</option>
                        </select>
                    </div>
    
                </div>
                
                {{-- Category --}}
                <div class="create-bar-block">
                    <span class="font-bold">Chuyên mục</span>
                    <div class="my-2 py-2 max-h-32 overflow-auto">
    
    
                        @if (!empty($categories))
    
                            @include('tenant.backend.posts.recursive-category', ['categories' => $categories])
                            
                        @endif
                    </div>
                    <a href="{{ route('ten.categories.index') }}">Thêm chuyên mục</a>
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
                    <div class="my-2">
                        <label for="featured_image" class="flex w-full h-28 justify-center items-center bg-gray-200 text-gray-500 hover:cursor-pointer">Đặt ảnh đại diện</label>
                        <input id="featured_image" class="hidden" type="file"
                            accept="image/png, image/jpeg" name="featured_image">
                    </div>
                </div>
    
                {{-- Excerpt --}}
                <div class="create-bar-block">
                    <span class="font-bold">Tóm tắt</span>
                    <div class="my-2">
                        <label for="excerpt">Viết mô tả rút gọn (tùy chọn)</label>
                        <textarea wire:model="excerpt" id="excerpt" class="w-full"
                            name="excerpt"></textarea>
                    </div>
                </div>
    
            </div>
        </div>
    
    </form>

</div>
