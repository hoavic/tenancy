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
                        <x-form.row.input wireKey="attribute.name" key="attributeName" label="Tên" placeholder="Size, Khối lượng,..."></x-form.row.input>

                        <x-form.row.select wireKey="attribute.visual" key="attributeVisual" label="Loại">
                            <option value="text">Text</option>
                            <option value="color">Color</option>
                            <option value="image">Image</option>
                        </x-form.row.select>
            
                    </div>
                    <p>
                        <x-button.secondary wire:click.prevent="$set('showCreateModal', false)">
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

    @if ($confirmingAttributeDeletion)
        <div class="confirm-modal modal-wrapper">
            <div class="modal-container">
                <form wire:submit="confirmingAttributeDeletion">
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
                            <button wire:click.prevent="$set('confirmingAttributeDeletion', false)">Cancel</button>
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
                @foreach($product->attributes as $attribute)
                <div class="relative w-full border border-gray-300 rounded-md p-4">
                    <div class="absolute -top-3 left-3 px-0.5 bg-white flex items-center space-x-1">
                        <button wire:click.prevent="confirmOptionDeletionFor('{{ $attribute->id }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400 hover:text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span class="font-medium text-sm text-gray-700 flex items-center">{{ $attribute->name }}</span>
                    </div>

                    @livewire('tenant.backend.commerce.attribute-option-manager', ['attribute' => $attribute])

                </div>
                @endforeach
            @endif
            
        </div>
    </div>
</div>
