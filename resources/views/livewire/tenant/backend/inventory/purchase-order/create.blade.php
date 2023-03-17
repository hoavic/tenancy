<div>
    <x-new-modal wireKey="isOpen">

        <div class="my-4 flex gap-4">
            <h2 class="m-0">Phiếu nhập hàng</h2><x-button.secondary wire:click.prevent="showAddItem">Thêm sản phẩm</x-button.secondary>
        </div>

        @if ($isShowAddItem)
            @include('livewire.tenant.backend.inventory.purchase-order.add-item')
        @endif

        @if (!empty($items))
            <div class="grid grid-cols-2 gap-4">
                @include('livewire.tenant.backend.inventory.purchase-order.item-loop')
            </div>
        @endif

        <form wire:submit.prevent="create">

            <h3>Tạm tính</h3>

            <p class="flex justify-between"><span>Tạm tính: {{ hCurrency($order->sub_total) }}</span><span>Chiết khấu: {{ hCurrency($order->item_discount) }}</span></p>
            
            <p><span>Tổng tiền hàng: {{ hCurrency($order->total) }}</span></p>
            
            <h3>Thiết lập thuế và phí vận chuyển</h3>

            <div class="grid grid-cols-2 gap-4">
    
                <x-form.row.input type="number" wireKey="order.tax" key="tax" label="Thuế">%</x-form.row.input>
    
                <x-form.row.input type="number" wireKey="order.shipping" key="shipping" label="Vận chuyển"></x-form.row.input>
    
            </div>

            <h3>Nhập mã giảm giá</h3>

            <x-form.row.input wireKey="order.promo" key="promo" label="Nhập mã giảm giá (nếu có)"></x-form.row.input>

            <p><span>Số tiền được giảm: {{ hCurrency($order->discount) }}</span></p>

            <h2>Thanh toán</h2>

            <p><strong>Số tiền Thanh toán cuối cùng: {{ hCurrency($order->grand_total) }}</strong></p>

            <x-form.row.input wireKey="order.note" key="note" label="Thêm ghi chú"></x-form.row.input>

            <p class="text-right">
                <x-button.primary wire:click.prevent="store">{{ $submitLabel }}</x-button.primary>               
            </p>
        
        </form>
    </x-new-modal>
</div>