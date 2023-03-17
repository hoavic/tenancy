<x-new-modal wireKey="isShowAddItem">
    <div class="p-2 my-2 border border-gray-300 ">
        <p><label>Nhập SKU hoặc tên để chọn nhanh sản phẩm</label></p>
        <p><input type="text" wire:model="search" name="search" id="search"/></p>
    </div>
    
    <div class="product-result border border-green-200">
        @if (!empty($error))
            <p>{{ $error }}</p>
        @endif
        @if (!empty($product_searches))
            @foreach ($product_searches as $product_search)
                <p><button wire:click.prevent="selectProduct({{ $product_search->id }})">{{ $product_search->name }}</button></p>
            @endforeach
        @endif
    </div>
    @if (!empty($product_selected))
    <h2> Sản phẩm đã chọn</h2>
        <p>Tên sản phẩm: {{ $product_selected->name }}</p>
        <p>Mã SKU: {{ $product_selected->SKU }}</p>
        @livewire('tenant.backend.inventory.item-manager', ['product' => $product_selected, 'order' => $order])
    @endif

</x-new-modal>