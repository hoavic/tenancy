<div>

    <x-button.secondary wire:click.prevent="showModal()">Chọn thuộc tính</x-button.secondary>

    <x-new-modal wireKey="modalShowed">

        <x-slot name="header">
            <h3>Thuộc tính khả dụng</h3>
        </x-slot>

        <x-table>
            <x-slot name="thead">
                <th>Tên</th>
                <th>Loại</th>
                <th>Giá trị</th>
                <th>Hành động</th>
            </x-slot>
    
            @if ($attributes->count())
    
                @foreach ($attributes as $attribute_item)
                            
                    <tr class="border-b border-gray-200">

                        <td>{{ $attribute_item->name }}
                            @if ($attribute_item->group)
                                <span>({{ $attribute_item->group }})</span>
                            @endif
                        </td>
                        <td>{{ $attribute_item->visual }}</td>
                        <td>
                            @foreach ($attribute_item->attribute_values as $value)
                                <span>{{ $value->label }},</span>
                            @endforeach
                        </td>
                        <td>
                            <x-button.text wireKey="select({{ $attribute_item->id }})">Thêm</x-button.text>
                        </td>
                    </tr>
                    
                @endforeach
            @else
                <tr><td>Không có.</td></tr>   
            @endif 
    
        </x-table>

        <x-slot name="footer">
            <x-button.primary wire:click.prevent="hideModal()">Đóng</x-button.primary>
        </x-slot>

        {{ $attributes->links() }}
    </x-new-modal>

    <x-table>
        <x-slot name="thead">
            <th>Tên</th>
            <th>Loại</th>
            <th>Giá trị</th>
            <th>Hành động</th>
        </x-slot>

        @if (!empty($selectedProductAttributes->count()))
            @foreach ($selectedProductAttributes as $product_attribute)
                        
                <tr class="border-b border-gray-200">

                    <td>{{ $product_attribute->attribute->name }}
                        @if ($product_attribute->attribute->group)
                            <span>({{ $product_attribute->attribute->group }})</span>
                        @endif
                    </td>
                    <td>{{ $product_attribute->attribute->visual }}</td>
                    <td>
{{--                         @foreach ($attribute_item->attribute_values as $value)
                            <span>{{ $value->label }},</span>
                        @endforeach --}}
                        @livewire('tenant.backend.commerce.product.product-attribute-value-manager', ['product' => $product, 'product_attribute' => $product_attribute], key($product_attribute->id))
                    </td>
                    <td>
                        <x-button.delete wire:click.prevent="confirmDelete({{ $product_attribute->id }})">thuộc tính   </x-button.delete>
                    </td>
                </tr>
                
            @endforeach
            
        @else
            <tr><td>Chưa liên kết thuộc tính sản phẩm.</td></tr>

        @endif 

    </x-table>
    <x-new-modal.delete-confirm  wireKey="modalDeleteShowed"></x-new-modal.delete-confirm>

    <p>
        <x-button.primary wire:click.prevent="createItems()">Tạo mới tất cả biến thể</x-button.primary>
        <x-button.primary wire:click.prevent="updateItems()">Cập nhật các biến thể</x-button.primary>
    </p>
</div>
