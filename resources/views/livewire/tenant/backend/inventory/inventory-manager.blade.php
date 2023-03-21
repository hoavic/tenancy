<div>
    <x-slot name="title">Tình trạng tồn kho</x-slot>
    <x-slot name="header">Tình trạng tồn kho</x-slot>

@livewireStyles()

    @include('tenant.backend.includes.error')
    @include('tenant.backend.includes.notification')

    <h3>Theo tháng <x-button wire:click.prevent="allTime()">Tất cả</x-button></h3>

    <div class="flex gap-4">
        <div>
            <x-form.row.input type="datetime-local" wireKey="beginning" key="beginning" label="Bắt đầu" row="grid"></x-form.row.input>
        </div>
        <div>
            <x-form.row.input type="datetime-local" wireKey="ending" key="ending" label="Kết thúc" row="grid"></x-form.row.input>
        </div>
        <div>
            <x-button.primary type="submit" wire:click.prevent="productFillter()">Lọc</x-button.primary>
        </div>
    </div>
{{ $beginning }}
    <div class="">

        <table class="table border w-full bg-white shadow">
            <thead class="text-left">
                <tr class="border-b border-gray-300">
                    <th><input type="checkbox" name="" class="rounded"/></th>
                    <th>Tên sản phẩm</th>
                    <th>Giá Nhập</th>
                    <th>Số lượng nhập</th>
                    <th>Giá trị nhập</th>
                    <th>Đã bán / xuất</th>
                    <th>Tồn kho</th>
                </tr>
            </thead>
            <tbody>
                @if ($products)

                    @foreach ($products as $product)
                                
                        <tr class="border-b border-gray-200">
                            <td><input type="checkbox" name="" class="rounded"/></td>
                            <td class="has-sub">{{ $product->name }}
                                <div class="sub-item">
                                    <button wire:click.prevent="edit({{ $product->id }})">Chỉnh sửa</button>

                                    <button wire:click.prevent="delete({{ $product->id }})">Xóa</button>
                                </div></td>
                            <td>{{ hCurrency($product->getIventoryMediumPrice()) }}</td>
                            <td>{{ $product->getInventoryQuantity() }}</td>
                            <td>{{ hCurrency($product->getInventoryAmount()) }}</td>
                            <td>{{ $product->getInventorySold() }}</td>
                            <td>{{ $product->getInventory() }}</td>
                        </tr>
                        
                    @endforeach
                    
                @endif 
            </tbody>
        </table>
    </div>

@livewireScripts()
</div>
