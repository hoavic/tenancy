<div class="p-4 bg-white rounded border border-gray-200">
    @if (!empty($items))
        @foreach ($items as $item)
            <div class="item-row grid grid-cols-3 gap-4 ">

                <x-form.row.input type="number" wireKey="item.SKU" key="SKU" label="Mã sản phẩm" row="grid"/>
                <x-form.row.input type="number" wireKey="item.price" key="price" label="Giá mua" row="grid"/>
                <x-form.row.input type="number" wireKey="item.quantity" key="quantity" label="Số lượng" row="grid"/>

                <x-form.row.select wireKey="item.location_id" key="location_id" label="Chọn kho lưu trữ" row="grid">
                    @if (!empty($locations))
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    @endif
                </x-form.row.select>

                <x-form.row.select wireKey="item.supplier_id" key="supplier_id" label="Nhà cung cấp" row="grid">
                    @if (!empty($suppliers))
                        @foreach ($suppliers as $supplier)
                            <option value={{ $supplier->id }}>{{ $supplier->company_name }}</option>
                        @endforeach
                    @endif
                </x-form.row.select>
        
            </div>
        @endforeach
    @endif
</div>
