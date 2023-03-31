<div>
    <x-slot name="title">Thuộc tính</x-slot>
    <x-slot name="header">Thuộc tính</x-slot>

    @include('tenant.backend.includes.notification')

    {{-- List Att --}}

    <x-table.top-action></x-table.top-action>
    <x-table>
        <x-slot name="thead">
            <th><input type="checkbox" name="" class="rounded"/></th>
            <th>Tên</th>
            <th>Loại</th>
            <th>Giá trị</th>
            <th>Hành động</th>
        </x-slot>

        @if ($attributes)

                @foreach ($attributes as $attribute_item)
                            
                    <tr class="border-b border-gray-200">
                        <td>
                            <x-form.input class="selectEle" type="checkbox" wire:model="selectedEles" value='{{ $attribute_item->id }}'></x-form.input>
                        </td>
                        <td class="has-sub">{{ $attribute_item->name }}
                            @if ($attribute_item->group)
                                <span>({{ $attribute_item->group }})</span>
                            @endif
                        </td>
                        <td>{{ $attribute_item->visual }}</td>
                        <td>
                            @foreach ($attribute_item->attribute_values as $value)
                                <span>{{ $value->label }},</span>
                            @endforeach
                            <x-button.text wire:click.prevent="addValue({{ $attribute_item->id  }})">Thêm giá trị</x-button.text>
                        </td>
                        <td>
                            <x-button.edit wireKey="edit({{ $attribute_item->id }})"></x-button.edit>
                            <x-button.delete wireKey="confirmDelete({{ $attribute_item->id }})"></x-button.delete>

                        </td>
                    </tr>
                    
                @endforeach

                {{-- show Add Att Values --}}
                @if ($showAddValue)
                    <x-new-modal id="addValue" wireKey="showAddValue">

                        <x-slot name="header">
                            <h3>Thêm giá trị</h3>
                        </x-slot>
                        {{-- <x-form.row.input wireKey="attributeValue.attribute_id" key="attribute_id"></x-form.row.input> --}}
                        <x-form.row.input wireKey="attributeValue.label" key="label" label="Nhãn" row="grid"></x-form.row.input>
                        <x-form.row.input wireKey="attributeValue.value" key="value" label="Giá trị*" row="grid"></x-form.row.input>

                        <x-slot name="footer">
                                <x-button.secondary wire:click.prevent="$set('showAddValue', false)">Hủy</x-button.secondary>
                                <x-button.primary wire:click.prevent="storeValue()">Lưu</x-button.primary>
                        </x-slot>
                    </x-new-modal>
                @endif
                
            @endif 

    </x-table>
    {{ $attributes->links() }}

    {{-- create - edit --}}
    
    <x-new-modal.showModal tag="form" id="showModal" wireKey="modalShowed">

        <x-slot name="header">
            <h3>{{ $submitLabel }} Thuộc tính</h3>
        </x-slot>

        <x-form.row.input wireKey="attribute.name" key="attributeName" label="Tên" row="grid"></x-form.row.input>

        <x-form.row.input wireKey="attribute.group" key="attributeGroup" label="Nhóm" row="grid"></x-form.row.input>

        <x-form.row.select wireKey="attribute.visual" key="attributeVisual" label="Loại" row="grid">
            <option value="text">Text</option>
            <option value="color">Color</option>
            <option value="image">Image</option>
        </x-form.row.select>
        
    </x-new-modal.showModal>

    <x-new-modal.delete-confirm wire:ignore.self wireKey="modalDeleteShowed"></x-new-modal.delete-confirm>

</div>
