<div>
    @if (!empty($product->items))
{{--     {{ dd($items) }} --}}
        @foreach ($product->items as $item)
            <div class="my-2 py-2  px-4 bg-white rounded">
                <h3>
                    #{{ $loop->iteration }} {{ $product->name }}
                    @if (!empty($item->variants->count()))
                        <em>
                            (
                            @foreach ($item->variants as $variant)
                                <span>{{ $variant->product_attribute->attribute->name }}: {{ $variant->attribute_value->value }}@if(!$loop->last),@endif</span>
                            @endforeach
                            )
                        </em>
                    @endif
                </h3>
                <div class="item-row grid grid-cols-2 gap-x-4">
                    <x-form.row.input wireKey="items.{{ $loop->index }}.sku" key="sku" label="Mã sản phẩm" row="grid"/>
                    <x-form.row.input wireKey="items.{{ $loop->index }}.barcode" key="barcode" label="Barcode" row="grid"/>
                    <x-form.row.input type="number" wireKey="items.{{ $loop->index }}.price" key="price" label="Giá" row="grid"/>
                    <x-form.row.input type="number" wireKey="items.{{ $loop->index }}.quantity" key="quantity" label="Tồn kho" row="grid"/>
            
                </div>
            </div>

        @endforeach
    @endif
</div>
