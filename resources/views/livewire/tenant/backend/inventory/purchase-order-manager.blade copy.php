<div>
    <x-slot name="title">Nhập hàng</x-slot>
    <x-slot name="header">Nhập hàng</x-slot>

@livewireStyles()

    @include('tenant.backend.includes.error')
    @include('tenant.backend.includes.notification')

    <div class="">
        <p>
            <x-button.primary wire:click.prevent="create">Tạo mới</x-button.primary>

        </p>
        @if($isOpen)
            @include('livewire.tenant.backend.inventory.purchase-order.create')
        @endif
        <table class="table border w-full bg-white shadow">
            <thead class="text-left">
                <tr class="border-b border-gray-300">
                    <th><input type="checkbox" name="" class="rounded"/></th>
                    <th>Thời gian</th>
                    <th>Mã phiếu</th>
                    <th>Trạng thái</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders)

                    @foreach ($orders as $order_item)
                                
                        <tr class="border-b border-gray-200">
                            <td><input type="checkbox" name="" class="rounded"/></td>
                            <td class="has-sub">{{ $order_item->created_at }}
                                <div class="sub-item">
                                    <button wire:click.prevent="edit({{ $order_item->id }})">Chỉnh sửa</button>

                                    <button wire:click.prevent="delete({{ $order_item->id }})">Xóa</button>
            

                                </div></td>
                            <td>#{{ $order_item->id }}</td>
                            <td>{{ $order_item->status }}</td>
                            <td>
                                {{ $order_item->getTotalQuantity() }}
                            </td>
                            <td>
                                @if ($order_item->status != 'draft')
                                    {{ hCurrency($order_item->grand_total) }}
                                @endif
                            </td>
                        </tr>
                        
                    @endforeach
                    
                @endif 
            </tbody>
        </table>
    </div>

@livewireScripts()
</div>
