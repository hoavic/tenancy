<div>
    <x-slot name="title">Thương hiệu</x-slot>
    <x-slot name="header">Thương hiệu</x-slot>

@livewireStyles()

    @include('tenant.backend.includes.notification')

    <div class="cate-grid">
        <div class="">
            <h2>Thêm thương hiệu</h2>
            <form wire:submit.prevent="save">
                @csrf
                <div class="my-4">
                    <label>Tên</label>
                    <input wire:model.prevent="brand.title" type="text" id="title" name="title" class="block w-full rounded"/>
                </div>

                <div class="my-4">
                    <label>Slug</label>
                    <input wire:model.prevent="brand.slug" type="text" id="slug" name="slug" class="block w-full rounded"/>
                </div>

                <div class="my-4">
                    <label>Mô tả</label>
                    <textarea wire:model.prevent="brand.description" id="description" name="description" class="block w-full rounded"></textarea>
                </div>

                <div class="my-4">
                    <span class="font-bold">Logo</span>
                    <input wire:model.prevent="brand.featured" type="text" id="featured" name="featured" hidden/>
                    @if (!empty($brand->featured))
                    
                        <div wire:click.prevent="$emit('openUpload')" class="editor-featured-image">
                            {{ $logo('thumbnail') }}
                        </div>
                        @livewire('tenant.backend.media-popup', ['featured' => $brand->featured])
                    @else
                        <div wire:click.prevent="$emit('openUpload')" class="editor-featured-image">Click để tải file lên</div>
                        @livewire('tenant.backend.media-popup', ['featured' => ''])
                    @endif  
                    
                </div>
                
                <div class="my-4">
                    <button wire:click.prevent="create" class="block py-2 px-4 rounded bg-blue-600 text-white">Thêm chuyên mục</button>               
                </div>
            
            </form>
        </div>
        <div class="">
            <form class="my-4 float-left flex gap-4 items-center">
                <select name="action" class="rounded">
                    <option>Hành động</option>
                    <option value="delete">Xóa</option>
                </select>
                <input class="inline-block py-2 px-4 bg-blue-600 text-white rounded" type="submit" value="Áp dụng"/>
            </form>
            <table class="table border w-full bg-white shadow">
                <thead class="text-left">
                    <tr class="border-b border-gray-300">
                        <th><input type="checkbox" name="" class="rounded"/></th>
                        <th>Logo</th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Slug</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($brands)

                        @foreach ($brands as $brand_item)
                                    
                            <tr class="border-b border-gray-200">
                                <td><input type="checkbox" name="" class="rounded"/></td>
                                <td>
                                    @if (!empty($brand_item->featured))
                                        <img src="{{ $brand_item->featuredImage->getUrl('thumbnail') }}" alt="{{ $brand_item->title }}" />  
                                    @else
                                        <span class="blank-image"></span>  
                                    @endif
                                </td>
                                <td class="has-sub">{{ $brand_item->title }}
                                    @if ($brand_item->id === 1)
                                        <sup class="default-sup">Mặc định</sup>
                                    @endif
                                    <div class="sub-item">
                                        <button wire:click.prevent="">Chỉnh sửa</button>

                                        <button wire:click.prevent="delete('{{ $brand_item->id }}')">Xóa</button>
                

                                    </div></td>
                                <td>{{ $brand_item->description }}</td>
                                <td>{{ $brand_item->slug }}</td>
                                <td>{{ $brand_item->count }}</td>
                            </tr>
                            
                        @endforeach
                        
                    @endif 
                </tbody>
            </table>
        </div>
    </div>
    @livewireScripts()
</div>
