
@foreach ($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->product->name }}</td>
        <td>{{ hCurrency($item->MRP) }}</td>
        <td>{{ hCurrency($item->discount) }}</td>
        <td>{{ hCurrency($item->price) }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ hCurrency($item->price * $item->quantity) }}</td>
    </tr>
{{--     <div class="item-row py-1 px-2 bg-gray-100 rounded">
        <p>Tên sản phẩm: {{ $item->product->name }}</p>
        <p>Nhà cung cấp: {{ $item->supplier->company_name }}</p>
        <p>Giá nhập: {{ $item->price }} - Số lượng: {{ $item->quantity }}</p>
        <p>Nhập kho: {{ $item->location->name ?? 'Chưa phân bổ' }}</p>
    </div> --}}
@endforeach
