<div>
    <x-button.secondary wire:click.prevent="create">Thêm mặt hàng</x-button.secondary>
    {{-- {{ dd($purchase->id) }} --}}

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tên mặt hàng</th>
                <th>Giá nhập</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($purchaseItems->count()))
                @foreach ($purchaseItems as $purchaseItem_item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span>{{ $purchaseItem_item->item->product->name }}</span><br>
                            <em>{{ $purchaseItem_item->item->getVariantNames() }}</em>
                        </td>
                        <td>{{ hCurrency($purchaseItem_item->price) }}</td>
                        <td>{{ $purchaseItem_item->quantity }}</td>
                        <td>{{ hCurrency($purchaseItem_item->price * $purchaseItem_item->quantity) }}</td>
                        <td>
                            <x-button.delete wireKey="confirmDelete({{ $purchaseItem_item->id }})"></x-button.delete>
                        </td>
                    </tr>
                @endforeach
            @endif    
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Tổng</th>
                <th></th>
                <th>{{ $purchase->getTotalQuantity() }}</th>
                <th>{{ hCurrency($purchase->getTotalAmount()) }}</th>
            </tr>
        </tfoot>
    </table>

    <x-new-modal wireKey="modalShowed">

        <x-slot name="header">
            <h3>Chọn mặt hàng #{{ $purchase->id }}</h3>
        </x-slot>

        <div class="p-2 my-2 border border-gray-300 ">
            <p><label>Nhập SKU hoặc tên để chọn nhanh mặt hàng</label></p>
            <p><input type="text" wire:model="searchItem" name="searchItem" id="searchItem"/></p>
        </div>
        
        <div class="product-result border border-green-200">
            @if (!empty($error))
                <p>{{ $error }}</p>
            @endif
            @if (!empty($itemSearches))
                @foreach ($itemSearches as $item)
                {{-- {{ dd($item->variants) }} --}}
                    <p><button wire:click.prevent="selectItem({{ $item->id }})">
                        {{ $item->product->name }}
                        <em>{{ $item->getVariantNames() }}</em>
                    </button></p>
                @endforeach
            @endif
        </div>

        @if (!empty($purchaseItem))
            <h2> Nhập Giá và Số lượng</h2>
            <form>
                @if (!empty($itemSearchSelected))
                    <p>Sản phẩm đã chọn: {{ $itemSearchSelected->product->name }}<br><em>{{ $itemSearchSelected->getVariantNames() }}</em></p>
                    <p>Mã SKU: {{ $itemSearchSelected->SKU }}</p>
                @endif
                <x-form.row.input type="number" wireKey="purchaseItem.price" key="purchaseItemPrice" label="Giá nhập"></x-form.row.input>
                <x-form.row.input type="number" wireKey="purchaseItem.quantity" key="purchaseItemQuantity" label="Sô lượng"></x-form.row.input>
                <p>
                    <x-button.secondary wire:click.prevent="saveAndContinue">Lưu & Tiếp</x-button.secondary>
                    <x-button.primary wire:click.prevent="saveAndClose">Lưu & Đóng</x-button.primary>
                </p>
            </form>
        @endif
    
    </x-new-modal>

    <x-new-modal.delete-confirm wireKey="modalDeleteShowed"></x-new-modal.delete-confirm>

</div>
