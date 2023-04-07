<div>
    <x-slot name="title">Nhập hàng</x-slot>
    <x-slot name="header">Nhập hàng</x-slot>

    @include('tenant.backend.includes.error')
    @include('tenant.backend.includes.notification')

    <p><x-button.primary wire:click.prevent="create">Tạo mới</x-button.primary></p>

    @if($modalShowed)
        @include('livewire.tenant.backend.inventory.purchase.create')
    @endif

    <table class="table bpurchase w-full bg-white shadow">
        <thead class="text-left">
            <tr class="bpurchase-b bpurchase-gray-300">
                <th><input type="checkbox" name="" class="rounded"/></th>
                <th>Thời gian</th>
                <th>Mã phiếu</th>
                <th>Trạng thái</th>
                <th>Mặt hàng</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @if ($purchases)

                @foreach ($purchases as $purchase_item)
                            
                    <tr class="bpurchase-b bpurchase-gray-200">
                        <td><input type="checkbox" name="" class="rounded"/></td>
                        <td class="has-sub">{{ $purchase_item->created_at }}
                            <div class="sub-item">
                                <button wire:click.prevent="edit({{ $purchase_item->id }})">Chỉnh sửa</button>

                                <button wire:click.prevent="delete({{ $purchase_item->id }})">Xóa</button>
        

                            </div></td>
                        <td>#{{ $purchase_item->id }}</td>
                        <td>{{ $purchase_item->status }}</td>
                        <td>
                            {{ $purchase_item->purchaseItems->count() }}
                        </td>
                        <td>{{ $purchase_item->getTotalQuantity() }}</td>
                        <td>
                            {{ hCurrency($purchase_item->grand_total) }}
                        </td>
                    </tr>
                    
                @endforeach
                
            @endif 
        </tbody>
    </table>


</div>
