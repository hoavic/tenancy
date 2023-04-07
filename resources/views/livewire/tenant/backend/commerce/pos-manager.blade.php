<div>
    <div 
        x-data="{
            order:  $wire.get('order')
        }"
        class="p-4 grid md:grid-cols-3 gap-4 bg-blue-50 min-h-screen">

        <div class="bill">


            <div class="bill-header p-4 grid grid-cols-2 gap-4 bg-white rounded">
                <select wireKey="order.customer_id">
                    <option>-- Chọn khách hàng  --</option>
                    @if (!empty($customers->count()))
                        @foreach ($customers as $customer)
                            <option value={{ $customer->id }}>{{ $customer->name }} - {{ $customer->phone }}</option>
                        @endforeach   
                    @endif
                </select>

                <select wireKey="order.stock_id">
                    <option>-- Chọn kho hàng  --</option>
                    @if (!empty($stocks->count()))
                        @foreach ($stocks as $stock)
                            <option value={{ $stock->id }} @if (!empty($order->stock_id) && $stock->id === $order->stock_id)
                                selected
                            @endif>{{ $stock->location->name }}</option>
                        @endforeach   
                    @endif
                </select>
            </div>

            <div class="bill-content flex flex-col justify-between gap-4">
                <x-table class="h-full">
                    <x-slot name="thead">
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tạm tính</th>
                    </x-slot>

                    @if (!empty($order->orderItems->count()))
                    {{-- {{ dd($order->orderItems) }} --}}
                        @foreach ($order->orderItems as $index => $orderItem)
                            <tr>
                                <td>{{ $orderItem->item->getFullName() }}</td>
                                <td>{{ $orderItem->quantity }}</td>
                                <td>{{ hCurrency($orderItem->price) }}</td>
                                <td>{{ hCurrency($orderItem->amount()) }}</td>
                            </tr>
                        @endforeach
                    @endif

                </x-table>

                <div class="sub-total grid grid-cols-2 gap-2">
                    <div class="">
                        <x-form.row.input wireKey="order.tax" key="tax" placeholder="Thuế"></x-form.row.input>
                        <x-form.row.input wireKey="order.discount" key="discount" placeholder="Giảm giá"></x-form.row.input>
                    </div>
                    <div class="">
                        <p>Tổng mặt hàng: {{ $order->getTotalQuantity() }}</p>
                        <p>Tạm tính: {{ hCurrency($order->sub_total) }}</p>
                        <p>Giảm giá: {{ hCurrency($order->discount) }}</p>
                        <p>Thuế: {{ hCurrency($order->sub_total*$order->tax/100) }}</p>
                        <p>Tổng cộng: {{ hCurrency($order->grand_total) }}</p>
                    </div>

                </div>

                <div class="action flex gap-4   ">
                    <button wire:click.prevent="holdOrder" class="py-2 px-4 min-w-[30%] bg-pink-500 text-white rounded">Giữ</button>
                    <button wire:click.prevent="resetOrder" class="py-2 px-4 min-w-[30%] bg-red-500 text-white rounded">Xóa</button>
                    <button wire:click.prevent="payOrder" class="py-2 px-4 min-w-[30%] bg-green-600 text-white rounded">Thanh toán</button>
                </div>
            </div>


        </div>

        <div class="products md:col-span-2">

            <div class="products-header p-4 flex gap-4 bg-white rounded">
                <input class="w-full" type="text" wire.model="search" />
                <x-button.text @click="console.log(order)">Log</x-button.text>
                <x-button.transferent href="{{ route('ten.dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                </x-button.transferent>
                <x-button.transferent onclick="openFullscreen()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 01-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 110-2h4a1 1 0 011 1v4a1 1 0 11-2 0V6.414l-2.293 2.293a1 1 0 11-1.414-1.414L13.586 5H12zm-9 7a1 1 0 112 0v1.586l2.293-2.293a1 1 0 011.414 1.414L6.414 15H8a1 1 0 110 2H4a1 1 0 01-1-1v-4zm13-1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 110-2h1.586l-2.293-2.293a1 1 0 011.414-1.414L15 13.586V12a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                </x-button.transferent>
            </div>

            <div class="products-grid my-4 grid grid-cols-2  md:grid-cols-6 gap-4">
                @if (!empty($items->count()))
                    @foreach ($items as $item)
                        <div class="item relative bg-white shadow-xl rounded" wire:click.prevent="select({{ $item->id }})">
                            <span class="absolute top-0 right-0 px-2 text-sm bg-cyan-500 text-white rounded">{{ $item->currentQuantity() }}</span>
                            <img class="flex w-full rounded-t" loading="lazy" 
                                src="@if(!empty($item->product->featuredImage)){{$item->product->featuredImage->getUrl('thumbnail') }}@else{{ global_asset('/asset/img/default-thumbnail.jpg') }}@endif" alt="{{ $item->product->name }}"/>
                            <h3 class="my-2 px-2 text-md">{{ $item->product->name }}</h3>
                            @if ($item->sku)
                            <span class="my-2 px-2 block text-sm">{{ $item->sku }}</span>
                            @endif
                            <span class="my-2 px-2 block text-sm text-red-600 font-bold">{{ hCurrency($item->price) }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
            
        </div>

    </div>
    <script>
        var elem = document.getElementsByTagName("BODY")[0];
        function openFullscreen() {
          if (elem.requestFullscreen) {
            elem.requestFullscreen();
          } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
          } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
          }
        }
    </script>
</div>
