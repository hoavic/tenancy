<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="flex justify-between border-b border-gray-200 pb-4">
        <h2>Post Meta</h2>
        <button class="px-4 bg-blue-200 text-blue-800 rounded" wire:click.prevent="create()">Create</button>
    </div>
    @if ($showCreateModal)
        <div class="modal-wrapper">
            <div class="modal-container">
                <form wire:submit="save">
                    <div max-width="lg">
            
                            Create new product option
            
                        <div>
                            <div class="space-y-8 divide-y divide-gray-200">
                                <div class="sm:col-span-3">
                                    <label for="postMetaName" >Name</label>
                                    <div class="mt-1">
                                        <input wire:model.defer="postMeta.name" type="text" name="postMetaName" id="postMetaName" class="max-w-lg block w-full sm:max-w-xs sm:text-sm" placeholder="Eg: Size, Color" />
                                        {{-- {{ dd($post) }} --}}
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="postMetaVisual" >Visual</label>
                                    <div class="mt-1">
                                        <select wire:model.defer="postMeta.visual" name="postMetaVisual" id="postMetaVisual" class="max-w-lg block w-full sm:max-w-xs sm:text-sm">
                                            <option value="">Please select</option>
                                            <option value="text">Text</option>
                                            <option value="color">Color</option>
                                            <option value="image">Image</option>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
            
                    </div>
                    <div>
                        <button wire:click.prevent="$set('showCreateModal', false)">
                            Cancel
                        </button>
                        <button wire:click.prevent="save()">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if ($confirmingPostMetaDeletion)
        <div class="confirm-modal modal-wrapper">
            <div class="modal-container">
                <form wire:submit="confirmingPostMetaDeletion">
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
                            <button wire:click.prevent="$set('confirmingPostMetaDeletion', false)">Cancel</button>
                            <button wire:click.prevent="delete">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    
    <div class="">
        <div class="space-y-5">
            @if (!empty($post))
                @foreach($post->postMetas as $postMeta)
                <div class="relative w-full border border-gray-300 rounded-md p-4">
                    <div class="absolute -top-3 left-3 px-0.5 bg-white flex items-center space-x-1">
                        <button wire:click.prevent="confirmOptionDeletionFor('{{ $postMeta->id }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400 hover:text-red-500 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <span class="font-medium text-sm text-gray-700 flex items-center">{{ $postMeta->name }}</span>
                    </div>

                </div>
                @endforeach
            @endif
            
        </div>
    </div>
</div>
