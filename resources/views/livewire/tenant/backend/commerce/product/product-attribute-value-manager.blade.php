<div>

    @if ($selectedValues->count())
        <div class="flex gap-2">
            @foreach ($selectedValues as $selectedValue)
                <div :key="{{ $selectedValue->id }}" class="relative">
                    <x-button.secondary>{{ $selectedValue->attribute_value->label }}</x-button.secondary>
                    <x-button.top-delete wire:click.prevent="confirmDelete({{ $selectedValue->id }})" class=""></x-button.top-delete>
                </div> 
            @endforeach
        </div>
    @endif


    <x-button.text wire:click.prevent="showValue">Chọn giá trị</x-button.text>

    <x-new-modal wireKey="modalShowed">

        <x-slot name="header">
            <h3>Danh sách khả dụng</h3>
        </x-slot>

        @if ($values->count())
            @foreach ($values as $value)
                <x-button.secondary wire:click.prevent="select({{ $value->id }})">{{ $value->label }}</x-button.secondary>  
            @endforeach
        @else

        @endif

    </x-new-modal>

    <x-new-modal.delete-confirm  wireKey="modalDeleteShowed"></x-new-modal.delete-confirm>
</div>
