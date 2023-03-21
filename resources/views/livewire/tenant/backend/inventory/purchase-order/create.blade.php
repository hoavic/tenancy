<div>
    <x-new-modal wireKey="isOpen">

        <h2 class="m-0 text-center">
            <span class="uppercase">Phiếu nhập hàng #{{ $order->id }}</span>
            @if (!empty($order->status))
                <span class="text-gray-400">({{ $order->status }})</span>
            @endif
        </h2>

        <div class="grid grid-cols-2 gap-4">

            <x-form.row.select wireKey="supplier_id" key="supplier_id" label="Chọn nhà cung cấp" row="grid">
                @if ($suppliers)
                    @foreach ($suppliers as $supplier)
                        <option 
                            value="{{ $supplier->id }}"
        {{--                     {{ dd($supplier_id) }} --}}
                            @if ($supplier_id === $supplier->id)
                                selected
                            @endif
                            >
                            {{ $supplier->company_name }}
                        </option>
                    @endforeach
                    
                @endif
            </x-form.row.select>
            <div class="my-4"><x-button.secondary wire:click.prevent="showAddItem">Thêm sản phẩm</x-button.secondary></div>
            

        </div>

        @if ($isShowAddItem)
            @include('livewire.tenant.backend.inventory.purchase-order.add-item')
        @endif

        @if (!empty($items))
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá niêm yết</th>
                            <th>Chiết khấu</th>
                            <th>Giá nhập</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('livewire.tenant.backend.inventory.purchase-order.item-loop')
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Tổng</th>
                            <th></th>
                            <th>{{ hCurrency($order->item_discount) }}</th>
                            <th></th>
                            <th>{{ $order->getTotalQuantity() }}</th>
                            <th>{{ hCurrency($order->sub_total) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endif

        <form wire:submit.prevent="create">
            

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <h3>Thiết lập</h3>

                    <x-form.row.input type="number" wireKey="order.tax" key="tax" label="Thuế" row="grid"></x-form.row.input>
    
                    <x-form.row.input type="number" wireKey="order.shipping" key="shipping" label="Vận chuyển" row="grid"></x-form.row.input>

                    <x-form.row.input wireKey="order.promo" key="promo" label="Nhập mã giảm giá (nếu có)" row="grid"></x-form.row.input>

                    <x-form.row.input wireKey="order.note" key="note" label="Ghi chú đơn hàng (nếu có)" row="grid"></x-form.row.input>

                </div>

                <div>
                    <h3>Cộng đơn hàng</h3>

                    <p class="grid grid-cols-2 gap-4"><span>Tiền hàng:</span><span class="text-right"> {{ hCurrency($order->sub_total) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Thuế:</span><span class="text-right"> {{ hCurrency($this->order->tax * $order->sub_total / 100) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Vạn chuyển:</span><span class="text-right"> {{ hCurrency($this->order->shipping) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Giảm giá:</span><span class="text-right"> {{ hCurrency($order->discount) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Thanh toán:</span><span class="text-right"> {{ hCurrency($order->grand_total) }}</span></p>
        
                </div>
    
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-form.row.select wireKey="location_id" key="location_id" label="Chọn kho lưu trữ" row="grid">
                    @if ($locations)
                        @foreach ($locations as $location)
                            <option 
                                value="{{ $location->id }}"
                                @if ($location_id === $location->id)
                                    selected
                                @endif
                                >
                                {{ $location->name }}
                            </option>
                        @endforeach
                        
                    @endif
                </x-form.row.select>
    
                <div class="my-4 text-right">
                    <x-button.primary wire:click.prevent="store">{{ $submitLabel }}</x-button.primary>               
                </div>
            </div>


        
        </form>
    </x-new-modal>
</div>