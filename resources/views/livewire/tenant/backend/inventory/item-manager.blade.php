<div>
    @if (!empty($item))

        <div class="item-row">

{{--             <x-form.row.input type="number" wireKey="item.product_id" key="product_id" label="product_id" />
            <x-form.row.input type="number" wireKey="item.order_id" key="order_id" label="order_id" /> --}}

{{--             <x-form.row.select wireKey="item.supplier_id" key="supplier_id" label="Nhà cung cấp" >
                @if (!empty($suppliers))
                    @foreach ($suppliers as $supplier)
                        <option value={{ $supplier->id }}>{{ $supplier->company_name }}</option>
                    @endforeach
                @endif
            </x-form.row.select> --}}

            <x-form.row.input type="number" wireKey="item.MRP" key="MRP" label="Giá niêm yết" />
            <x-form.row.input type="number" wireKey="item.discount" key="discount" label="Chiết khấu" />
            <x-form.row.input type="number" wireKey="item.price" key="price" label="Giá mua" />
            <x-form.row.input type="number" wireKey="item.quantity" key="quantity" label="Số lượng" />

{{--             <x-form.row.select wireKey="item.location_id" key="location_id" label="Chọn kho lưu trữ">
                @if ($locations)
                    @foreach ($locations as $location)
                        <option 
                            value="{{ $location->id }}"
                            @if ($item->location_id === $location->id)
                                selected
                            @endif
                            >
                            {{ $location->name }}
                        </option>
                    @endforeach
                    
                @endif
            </x-form.row.select> --}}
    
        </div>
        <p>
            <x-button.primary wire:click.prevent="addItem">Thêm Sản phẩm</x-button.primary>
        </p>
    @endif
</div>
