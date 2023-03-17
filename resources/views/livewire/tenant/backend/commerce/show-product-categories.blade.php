<div>
    <x-slot name="title">Danh mục sản phẩm</x-slot>
    <x-slot name="header">Danh mục sản phẩm</x-slot>
@livewireStyles()
@livewireScripts()

    @include('tenant.backend.includes.notification')

    <div class="cate-grid">
        <div class="">
            <h2>Thêm chuyên mục sản phẩm</h2>
            <form wire:submit.prevent="save">
                @csrf
                <div class="my-4">
                    <label>Tên</label>
                    <input wire:model="product_category.title" type="text" id="title" name="title" class="block w-full rounded"/>
                </div>

                <div class="my-4">
                    <label>Slug</label>
                    <input wire:model="product_category.slug" type="text" id="slug" name="slug" class="block w-full rounded"/>
                </div>

                <div class="my-4">
                    <label>Danh mục cha</label>
                    <select wire:model="product_category.parent_id" id="parent_id" name="parent_id" class="block w-full rounded">
                        <option value="0">Không có</option>

                        @if (!empty($product_categories))
                            @include('livewire.tenant.backend.commerce.recursive-select', ['product_categories' => $product_categories, 'prefix'       => ''])
                        @endif 

                    </select>

                    <span wire:text="product_category.parent_id"></span>
                </div>

                <div class="my-4">
                    <label>Mô tả</label>
                    <textarea wire:model="product_category.description" id="description" name="description" class="block w-full rounded"></textarea>
                </div>

                
                <div class="my-4">
                    <button wire:click.prevent="save" class="block py-2 px-4 rounded bg-blue-600 text-white">Thêm chuyên mục</button>               
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
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Slug</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($product_categories)
                        @include('livewire.tenant.backend.commerce.recursive', [
                                'product_categories' => $product_categories,
                                'prefix'       => '',
                            ])  
                    @endif 
                </tbody>
            </table>
        </div>
    </div>

</div>
