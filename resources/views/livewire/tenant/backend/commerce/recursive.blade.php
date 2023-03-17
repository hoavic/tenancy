@foreach ($product_categories as $product_category)
                            
    <tr class="border-b border-gray-200">
        <td><input type="checkbox" name="" class="rounded"/></td>
        <td class="has-sub">{{ $prefix.' '.$product_category->title }}
            @if ($product_category->id === 1)
                <sup class="default-sup">Mặc định</sup>
            @endif
            <div class="sub-item">

                <a href="{{ route('ten.product_categories.edit', $product_category->id) }}">Chỉnh sửa</a> 
                <a wire:click.prevent="delete({{  $product_category->id }})">{{ __('Xóa') }}</a>

            </div></td>
        <td>{{ $product_category->description }}</td>
        <td>{{ $product_category->slug }}</td>
        <td>{{ $product_category->count }}</td>
    </tr>

    @if (!empty($product_category->children))
        @php
            $prefix = $prefix.'-';
        @endphp
        @include('livewire.tenant.backend.commerce.recursive', [
                'product_categories' => $product_category->children
            ])

        @php
            $prefix = substr($prefix, 0, -1);
        @endphp    
    @endif
    
@endforeach