@foreach ($product_categories as $product_category)
                            
    <tr class="border-b border-gray-200">
        <td><input type="checkbox" name="" class="rounded"/></td>
        <td class="has-sub">{{ $prefix.' '.$product_category->title }}
            <div class="sub-item">
                <a href="{{ route('ten.product_categories.edit', $product_category->id) }}">Chỉnh sửa</a> 
                <form wire:submit.prevent="delete">
                    @csrf
                    @method('delete')
                    
                    <a wire:click.prevent="delete">
                        {{ __('Xóa') }}
                    </a>
                </form>
            </div></td>
        <td>{{ $product_category->description }}</td>
        <td>{{ $product_category->slug }}</td>
        <td>{{ $product_category->count }}</td>
    </tr>

    @if (!empty($product_category->children))
        @php
            $prefix = $prefix.'-';
        @endphp
        @include('livewire.tenant.backend.product.recursive', [
                'product_categories' => $product_category->children
            ])

        @php
            $prefix = substr($prefix, 0, -1);
        @endphp    
    @endif
    
@endforeach