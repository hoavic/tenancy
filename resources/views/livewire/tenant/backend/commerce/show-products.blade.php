<div>
    
    <x-slot name="title">Products</x-slot>
    <x-slot name="header">Products</x-slot>
    <x-slot name="header_button">
        <x-button.secondary :href="route('ten.products.create')">Thêm</x-button.secondary>
    </x-slot>

    @include('tenant.backend.includes.notification')

    <table>
        <thead>
            <tr>
               
                <th>O</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Tình trạng</th>
            </tr>
        </thead>
        <tbody>
            @if ($products)
                @foreach ($products as $product)
                    <tr>
                       
                        <td></td>
                        <td>
                            @if (!empty($product->featured_id))
                                
                            @endif
                            <img src=""/>
                        </td>
                        <td class="has-sub">
                            {{ $product->name }}
                            <div class="sub-item">
                                <a href="{{ route('ten.products.edit', $product) }}">Chỉnh sửa</a> 
                                <a href="" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Xóa') }}
                                </a>
                            </div>
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->status }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>



</div>
