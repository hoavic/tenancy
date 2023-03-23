<div class="app-box w-full">
    <div class="flex justify-between border-b border-gray-200 pb-4">
        <h2>Thuộc tính</h2>
        <button class="px-4 bg-blue-200 text-blue-800 rounded" wire:click.prevent="createAttribute()">Thêm</button>
    </div>
    {{-- {{ $product->id }} --}}
    @if ($showCreateModal)
        <div class="modal-wrapper">
            <div class="modal-container">
                <form wire:submit="save">
                    <div max-width="lg">

                        <h3>Thêm thuộc tính sản phẩm</h3>
                        <x-form.row.input wireKey="attributeValue.label" key="attributeValueLabel" label="Nhãn"></x-form.row.input>

                        <x-form.row.input wireKey="attributeValue.value" key="attributeValueValue" label="Giá trị"></x-form.row.input>

                    </div>
                    <p>
                        <x-button.secondary wire:click.prevent="$set('showCreateOptionModal', false)">
                            Hủy
                        </x-button.secondary>
                        <x-button.primary wire:click.prevent="save()">
                            Lưu
                        </x-button.primary>
                    </p>
                </form>
            </div>
        </div>
    @endif

    @if ($confirmingAttributeValueDeletion)
        <div class="confirm-modal modal-wrapper">
            <div class="modal-container">
                <form wire:submit="confirmingAttributeValueDeletion">
                    <div class="confirm-title">
                        Please confirm your action!
                    </div>
                    <div class="confirm-content">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to delete this category? This action cannot be undone!
                        </p>
                    </div>
                    <div class="confirm-footer">
                        <div>
                            <button wire:click.prevent="$set('confirmingAttributeValueDeletion', false)">Cancel</button>
                            <button wire:click.prevent="delete">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    
    <div class="">
        <div class="space-y-5">
            @if (!empty($product))
                @foreach($product->attributeValues as $attributeValue)
                <div class="relative w-full border border-gray-300 rounded-md p-4">
                    <div class="absolute -top-3 left-3 px-0.5 bg-white flex items-center space-x-1">
                        <button wire:click.prevent="confirmOptionDeletionFor('{{ $attributeValue->id }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400 hover:text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span class="font-medium text-sm text-gray-700 flex items-center">{{ $attributeValue->name }}</span>
                    </div>
                </div>
                @endforeach
            @endif
            
        </div>
    </div>
</div>
