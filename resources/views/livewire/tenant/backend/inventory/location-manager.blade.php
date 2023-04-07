<div>
    <x-slot name="title">Địa điểm</x-slot>
    <x-slot name="header">Địa điểm</x-slot>

    @include('tenant.backend.includes.notification')

    <div class="">
        <p>
            <x-button.primary wire:click.prevent="create">Tạo mới</x-button.primary>

        </p>
        @if($isOpen)
            @include('livewire.tenant.backend.inventory.location.create')
        @endif
        <table class="table border w-full bg-white shadow">
            <thead class="text-left">
                <tr class="border-b border-gray-300">
                    <th><input type="checkbox" name="" class="rounded"/></th>
                    <th>Tên địa điểm</th>
                    <th>Loại địa điểm</th>
                    <th>Địa chỉ</th>
{{--                     <th>Mặt hàng</th> --}}
                    <th>Tổng số lượng</th>
                    <th>Tổng giá trị</th>
                </tr>
            </thead>
            <tbody>
                @if ($locations)

                    @foreach ($locations as $location_item)
                                
                        <tr class="border-b border-gray-200">
                            <td><input type="checkbox" name="" class="rounded"/></td>
                            <td class="has-sub">{{ $location_item->name }}
                                @if ($location_item->id === 1)
                                    <sup class="default-sup">Mặc định</sup>
                                @endif
                                <div class="sub-item">
                                    <button wire:click.prevent="edit({{ $location_item->id }})">Chỉnh sửa</button>

                                    <button wire:click.prevent="delete({{ $location_item->id }})">Xóa</button>
            

                                </div></td>
                            <td>{{ json_decode($location_item->type)->label }}</td>
                            <td>{{ $location_item->addressFull() }}</td>
                            {{-- {{ dd($location_item->stock->currentQuantity()) }} --}}
                           {{--  <td></td> --}}
                            <td>{{ hFormat($location_item->stock->currentQuantity()) }}</td>
                            <td>{{ hCurrency($location_item->stock->getTotalPurchaseAmount()) }}</td>
                        </tr>
                        
                    @endforeach
                    
                @endif 
            </tbody>
        </table>
    </div>

</div>
