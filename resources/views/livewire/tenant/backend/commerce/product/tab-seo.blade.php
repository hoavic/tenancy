{{-- SEO --}}
<x-box.with-title>
    <x-slot name="title">Thiết lập SEO (tùy chọn)</x-slot>
    <x-slot name="content">
        <p class="input-flex">
            <label for="meta_title">Tiêu đề</label>
            <input type="text" wire:model.defer="product.meta_title" id="meta_title" name="meta_title"/>
        </p>
        <p class="input-flex">
            <label for="meta_keywords">Từ khóa</label>
            <input type="text" wire:model.defer="product.meta_keywords" id="meta_keywords" name="endmeta_keywords_at"/>
        </p>
        <label for="meta_description">Mô tả</label>
        <textarea wire:model.defer="product.meta_description" id="meta_description" class="w-full"
        name="meta_description"></textarea>
    </x-slot>

</x-box.with-title>