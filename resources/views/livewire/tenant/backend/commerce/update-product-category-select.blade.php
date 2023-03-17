@foreach ($product_categories as $product_category)

    <div class="pl-2">
        <div class="my-2 flex gap-2 items-center">
            <input id="cat{{ $product_category->id }}" wire:model="product_category_ids" class="rounded" type="checkbox" name="product_category_ids" value={{ $product_category->id }} 

                @foreach ($product_category_ids as $product_category_id)
                    @if ($product_category_id === $product_category->id)
                        checked
                    @endif
                @endforeach
            
            >
            <label for="cat{{ $product_category->id }}">{{ $product_category->title }}</label>
        </div>
    @if (!empty($product_category->children))

        @include('livewire.tenant.backend.commerce.update-product-category-select', ['product_categories' => $product_category->children])

    @endif

    </div>
    
@endforeach