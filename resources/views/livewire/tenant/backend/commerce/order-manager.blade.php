<div>
    <x-slot name="title">Đơn hàng</x-slot>
    <x-slot name="header">Đơn hàng</x-slot>

    @include('tenant.backend.includes.error')
    @include('tenant.backend.includes.notification')

    <p><x-button.primary wire:click.prevent="create">Tạo mới</x-button.primary></p>

    @if($modalShowed)
        @include('livewire.tenant.backend.commerce.order.create')
    @endif

    <table class="table border w-full bg-white shadow">
        <thead class="text-left">
            <tr class="border-b border-gray-300">
                <th><input type="checkbox" name="" class="rounded"/></th>
                <th>Thời gian</th>
                <th>Mã đơn hàng</th>
                <th>Loại</th>
                <th>Trạng thái</th>
                <th>Số sản phẩm</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($orders->count()))

                @foreach ($orders as $order_item)
                            
                    <tr class="border-b border-gray-200">
                        <td><input type="checkbox" name="" class="rounded"/></td>
                        <td class="has-sub">{{ $order_item->created_at }}
                            <div class="sub-item">
                                <button wire:click.prevent="edit({{ $order_item->id }})">Chỉnh sửa</button>

                                <button wire:click.prevent="delete({{ $order_item->id }})">Xóa</button>
        

                            </div></td>
                        <td>#{{ $order_item->id }}</td>
                        <td>{{ $order_item->type }}</td>
                        <td>{{ $order_item->status }}</td>
                        <td>
                            {{ $order_item->orderItems->count() }}
                        </td>
                        <td>
                            {{ hCurrency($order_item->grand_total) }}
                        </td>
                    </tr>
                    
                @endforeach
            @else
                <tr><td>Bạn chưa có đơn hàng nào</td></tr>
            @endif 
        </tbody>
    </table>


</div>
