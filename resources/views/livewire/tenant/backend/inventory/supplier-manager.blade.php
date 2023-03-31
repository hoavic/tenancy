<div>
    <x-slot name="title">Nhà Cung Cấp</x-slot>
    <x-slot name="header">Nhà Cung Cấp</x-slot>

    @include('tenant.backend.includes.error')
    @include('tenant.backend.includes.notification')

    <div class="">
        <p>
            <x-button.primary wire:click.prevent="create">Tạo mới</x-button.primary>

        </p>
        @if($isOpen)
            @include('livewire.tenant.backend.inventory.supplier.create')
        @endif
        <table class="table border w-full bg-white shadow">
            <thead class="text-left">
                <tr class="border-b border-gray-300">
                    <th><input type="checkbox" name="" class="rounded"/></th>
                    <th>Nhà cung cấp</th>
                    <th>Phân loại</th>
                    <th>Tỉnh\Thành</th>
                    <th>Mặt hàng</th>
                    <th>Tổng số lượng</th>
                    <th>Tổng giá trị</th>
                </tr>
            </thead>
            <tbody>
                @if ($suppliers)

                    @foreach ($suppliers as $supplier_item)
                                
                        <tr class="border-b border-gray-200">
                            <td><input type="checkbox" name="" class="rounded"/></td>
                            <td class="has-sub">{{ $supplier_item->company_name }}
                                @if ($supplier_item->id === 1)
                                    <sup class="default-sup">Mặc định</sup>
                                @endif
                                <div class="sub-item">
                                    <button wire:click.prevent="edit({{ $supplier_item->id }})">Chỉnh sửa</button>

                                    <button wire:click.prevent="delete({{ $supplier_item->id }})">Xóa</button>
            

                                </div></td>
                            <td>{{ $supplier_item->ranking }}</td>
                            <td>{{ $supplier_item->province->name ?? 'chưa thiết lập' }}</td>
                            <td>{{ $supplier_item->items->count() ?? 0 }}</td>
                            <td>{{ $supplier_item->items->sum('quantity') ?? 0 }}</td>
                            <td>{{ hCurrency(($supplier_item->items->sum('price') * $supplier_item->items->sum('quantity')) ?? 0) }}</td>
                        </tr>
                        
                    @endforeach
                    
                @endif 
            </tbody>
        </table>
    </div>
    
</div>
