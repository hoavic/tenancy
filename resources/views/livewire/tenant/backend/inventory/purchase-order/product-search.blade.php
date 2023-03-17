<div class="form-row">
    <label>Thêm sản phẩm</label>
    <input type="text" wire:model="search" name="search" id="search"/>
</div>

<div class="product-result">
    @if (!empty($error))
        <p>{{ $error }}</p>
    @endif
    @if (!empty($product_searches))
        @foreach ($product_searches as $product_search)
            <p><button wire:click.prevent="addProduct({{ $product_search }})">{{ $product_search->name }}</button></p>
        @endforeach
    @endif
</div>