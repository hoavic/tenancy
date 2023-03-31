<div>
    <x-new-modal wireKey="modalShowed">

        <x-slot name="header">
            <h2>
                <span class="uppercase">Phiếu nhập hàng #{{ $purchase->id }}</span>
                @if (!empty($purchase->status))
                    <span class="text-gray-400">({{ $purchase->status }})</span>
                @endif
            </h2>
        </x-slot>

        <h3>Bước 1: Chọn nhà cung cấp</h3>

        <div class="grid grid-cols-2 gap-4">
            <x-form.row.select wireKey="purchase.supplier_id" key="supplier_id" label="Chọn nhà cung cấp" row="grid">
                @if ($suppliers)
                    @foreach ($suppliers as $supplier)
                        <option 
                            value="{{ $supplier->id }}"
                            @if ($purchase->supplier_id === $supplier->id)
                                selected
                            @endif
                            >
                            {{ $supplier->company_name }}
                        </option>
                    @endforeach
                @endif
            </x-form.row.select>

        </div>

        <h3>Bước 2: Thêm mặt hàng</h3>

{{--         @if ($isShowAddItem)
            @include('livewire.tenant.backend.inventory.purchase.add-item')
        @endif --}}

        @livewire('tenant.backend.inventory.purchase-item-manager', ['purchase' => $purchase, 'supplier' => $supplier], key($purchase->id))
        
        <h3>Kết quả</h3>

        <form>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <h3>Thiết lập</h3>

                    <x-form.row.input type="number" wireKey="purchase.tax" key="tax" label="Thuế" row="grid"></x-form.row.input>
    
                    <x-form.row.input type="number" wireKey="purchase.shipping" key="shipping" label="Vận chuyển" row="grid"></x-form.row.input>

                    {{-- <x-form.row.input wireKey="purchase.promo" key="promo" label="Nhập mã giảm giá (nếu có)" row="grid"></x-form.row.input> --}}

                    <x-form.row.input wireKey="purchase.note" key="note" label="Ghi chú đơn hàng (nếu có)" row="grid"></x-form.row.input>

                </div>

                <div>
                    <h3>Cộng đơn hàng</h3>

                    <p class="grid grid-cols-2 gap-4"><span>Tiền hàng:</span><span class="text-right"> {{ hCurrency($purchase->sub_total) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Thuế:</span><span class="text-right"> {{ hCurrency($this->purchase->tax * $purchase->sub_total / 100) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Vận chuyển:</span><span class="text-right"> {{ hCurrency($this->purchase->shipping) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Giảm giá:</span><span class="text-right"> {{ hCurrency($purchase->discount) }}</span></p>

                    <p class="grid grid-cols-2 gap-4"><span>Thanh toán:</span><span class="text-right"> {{ hCurrency($purchase->grand_total) }}</span></p>
        
                </div>
    
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-form.row.select wireKey="purchase.stock_id" key="stock_id" label="Chọn kho lưu trữ" row="grid">
                    @if ($stocks)
                        @foreach ($stocks as $stock)
                            <option 
                                value="{{ $stock->id }}"
                                @if ($purchase->stock_id === $stock->id)
                                    selected
                                @endif
                                >
                                {{ $stock->location->name }}
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