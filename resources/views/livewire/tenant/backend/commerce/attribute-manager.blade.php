<div>
    <x-slot name="title">Thuộc tính</x-slot>
    <x-slot name="header">Thuộc tính</x-slot>

@livewireStyles()

    @include('tenant.backend.includes.notification')

    <div class="cate-grid">
        <div class="">
            <h2>Thêm thuộc tính</h2>
            <form wire:submit.prevent="save">
                @csrf

                <x-form.row.input wireKey="attribute.name" key="attributeName" label="Tên" row="grid"></x-form.row.input>

                <x-form.row.input wireKey="attribute.group" key="attributeGroup" label="Nhóm" row="grid"></x-form.row.input>

                <x-form.row.select wireKey="attribute.visual" key="attributeVisual" label="Loại" row="grid">
                    <option value="text">Text</option>
                    <option value="color">Color</option>
                    <option value="image">Image</option>
                </x-form.row.select>
                
                <div class="my-4">
                    <x-button.primary wire:click.prevent="create">Thêm thuộc tính</x-button.primary>               
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
                        <th>Loại</th>
                        <th>Giá trị</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($attributes)

                        @foreach ($attributes as $attribute_item)
                                    
                            <tr class="border-b border-gray-200">
                                <td><input type="checkbox" name="" class="rounded"/></td>
                                <td class="has-sub">{{ $attribute_item->name }}
                                    @if ($attribute_item->group)
                                        <span>({{ $attribute_item->group }})</span>
                                    @endif
                                    <div class="sub-item">
                                        <button wire:click.prevent="">Chỉnh sửa</button>

                                        <button wire:click.prevent="delete('{{ $attribute_item->id }}')">Xóa</button>
                                    </div>
                                </td>
                                <td>{{ $attribute_item->visual }}</td>
                                <td>
                                    
                                    @foreach ($attribute_item->attribute_values as $value)
                                        <span>{{ $value->label }},</span>
                                    @endforeach
                                </td>
                                <td><x-button wire:click.prevent="addValue({{ $attribute_item->id  }})">Thêm giá trị</x-button></td>
                            </tr>
                            
                        @endforeach

                        {{-- show Add Att Values --}}
                        @if ($showAddValue)
                            <x-new-modal id="addValue" wireKey="showAddValue">
                                <x-form.row.input wireKey="attributeValue.label" key="label" label="Nhãn"></x-form.row.input>
                                <x-form.row.input wireKey="attributeValue.value" key="value" label="Giá trị*"></x-form.row.input>
                                <p>
                                    <x-button.secondary wire:click.prevent="$set('showAddValue', false)">Hủy</x-button.secondary>
                                    <x-button.primary wire:click.prevent="storeValue()">Lưu</x-button.primary>
                                </p>
                            </x-new-modal>
                        @endif

                        @if ($showEditModal)
                            <x-new-modal id="showEditModal" wireKey="showEditModal">
                                <x-form.row.input wireKey="attribute.label" key="label" label="Nhãn"></x-form.row.input>
                                <x-form.row.input wireKey="attribute.value" key="value" label="Giá trị*"></x-form.row.input>
                                <p>
                                    <x-button.secondary wire:click.prevent="$set('showEditModal', false)">Hủy</x-button.secondary>
                                    <x-button.primary wire:click.prevent="storeValue()">Lưu</x-button.primary>
                                </p>
                            </x-new-modal>
                        @endif
                        
                    @endif 
                </tbody>
            </table>
        </div>
    </div>
    @livewireScripts()
</div>
