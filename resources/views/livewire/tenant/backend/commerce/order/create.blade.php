<div>
    <x-new-modal wireKey="modalShowed">

        <x-slot name="header">
            <h2>
                <span class="uppercase">Phiếu bán hàng #{{ $order->id }}</span>
                @if (!empty($order->status))
                    <span class="text-gray-400">({{ $order->status }})</span>
                @endif
            </h2>
        </x-slot>

        <h3>Bước 1: Chọn kho hàng</h3>

        <x-form.row.select wireKey="order.stock_id" key="stock_id" label="Chọn kho lưu trữ" row="grid">
            @if ($stocks)
                @foreach ($stocks as $stock)
                    <option 
                        value="{{ $stock->id }}"
                        @if ($order->stock_id === $order->stock_id)
                            selected
                        @endif
                        >
                        {{ $stock->location->name }}
                    </option>
                @endforeach
                
            @endif
        </x-form.row.select>

        <h3>Bước 2: Thêm mặt hàng</h3>

        @livewire('tenant.backend.commerce.order-item-manager', ['order' => $order], key($order->id))
        
        <h3>Kết quả</h3>

        <form>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <h3>Thiết lập</h3>

                    <x-form.row.input type="number" wireKey="order.tax" key="tax" label="Thuế" row="grid"></x-form.row.input>
    
                    <x-form.row.input type="number" wireKey="order.shipping" key="shipping" label="Vận chuyển" row="grid"></x-form.row.input>

                    {{-- <x-form.row.input wireKey="order.promo" key="promo" label="Nhập mã giảm giá (nếu có)" row="grid"></x-form.row.input> --}}

                    <x-form.row.input wireKey="order.note" key="note" label="Ghi chú đơn hàng (nếu có)" row="grid"></x-form.row.input>

                </div>

                <div>
                    <h3>Cộng đơn hàng</h3>

                    <p class="grid grid-cols-2 gap-4"><span>Tiền hàng:</span><span class="text-right"> {{ hCurrency($order->sub_total) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Thuế:</span><span class="text-right"> {{ hCurrency($this->order->tax * $order->sub_total / 100) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Vận chuyển:</span><span class="text-right"> {{ hCurrency($this->order->shipping) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Giảm giá:</span><span class="text-right"> {{ hCurrency($order->discount) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Thanh toán:</span><span class="text-right"> {{ hCurrency($order->grand_total) }}</span></p>
        
                </div>
    
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="my-4 text-right">
                    <x-button.primary wire:click.prevent="store">{{ $submitLabel }}</x-button.primary>               
                </div>
            </div>
        
        </form>
    </x-new-modal>
</div>