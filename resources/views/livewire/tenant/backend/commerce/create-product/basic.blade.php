<x-box.with-title>

    <x-slot name="title">Thiết lập sản phẩm</x-slot>

    <x-slot name="content">

        <div class="grid grid-cols-2 gap-4">
            <x-form.row.input row="flex" wireKey="product.price" key="price" label="Giá bán"></x-form.row.input>

            <x-form.row.input row="flex" wireKey="product.discount" key="discount" label="Giá khuyến mãi"></x-form.row.input>
    
            <x-form.row.input row="flex" type="datetime-local" wireKey="product.start_at" key="start_at" label="Bắt đầu"></x-form.row.input>
    
            <x-form.row.input row="flex" type="datetime-local" wireKey="product.end_at" key="end_at" label="Kết thúc"></x-form.row.input>
            
        </div>



    </x-slot>

</x-box.with-title>