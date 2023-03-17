<div>
    
    <p><x-button.secondary wire:click.prevent="openGrid()">Thư viện</x-button.secondary></p>
    @if (!empty($show))
        <div x-data="{ 
            handleClick($event) {
                $wire.current_attachment_id = $event.currentTarget.getAttribute('data-id');
                $event.currentTarget.classList.add('media-selected');
                console.log($wire.current_attachment_id);
            },
        }" class="media-model">
            <div class="media-model__top">
                <div class="text-right"><button id="doClose" wire:click.prevent="doClose()">X Đóng</button></div>
                <nav class="media-model__nav">
                    <a class="tab" :class="{ 'active': $wire.tab === 'upload' }" x-on:click.prevent="$wire.tab = 'upload'" href="#">Tải lên</a>
                    <a class="tab" :class="{ 'active': $wire.tab === 'grid' }" x-on:click.prevent="$wire.tab = 'grid'" href="#">Thư viện</a>
                </nav>
                @if ($errors->any())
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                @endif
            </div>

            {{-- upload --}}
            <div x-show="$wire.tab === 'upload'" class="media-model__upload">
                <form wire:submit.prevent="upload" enctype="multipart/form-data">
                    <label for="photo" class="">Đặt ảnh đại diện</label>
                    <input wire:model="photo" id="photo" type="file"
                        accept="image/png, image/jpeg" name="photo">
                    @error('photo') <span class="error">{{ $message }}</span> @enderror
                    <button>Upload</button>
                    @if(session()->has('returnphoto'))
                        <div class="p-4 m-4 block text-center bg-green-200 text-green-800 border border-green-600 rounded" role="alert">
                            {{ dd(session()->get('path')) }}
                        </div>
                    @endif
                    @if (!empty($path))
                        <p>{{ $path }}</p>
                    @endif
                    
                </form>
            </div>

            {{-- media grid --}}
            @if ($medias)
                <div x-show="$wire.tab === 'grid'" class="media-grid media-model__grid">
                    @foreach ($medias as $media)

                        <div class="media-item @if ($current_attachment_id == $media->id)
                            media-selected
                        @endif" data-id="{{ $media->id }}" @click.prevent="handleClick($event)">
                            <img src="{{ $media->getUrl('thumbnail') }}" alt="{{ $media->name }}" class="media-image" />
                            <span class="media-title">{{ $media->file_name }}</span>
                        </div>
                        
                    @endforeach

                </div>
            @endif
            <div class="media-model__bottom">
                <p class="text-right">
                    <button class="setFeatuedImage" @click.prevent="$wire.setAttachment()"
                        @if (empty($current_attachment_id) || $current_attachment_id == '')
                            disabled
                        @endif
                    >Đặt ảnh đại diện</button>
                </p>
            </div>
        </div>
        <script>
            document.addEventListener('keydown', (e) => {
                if (e.key === "Escape") {
                    document.getElementById('doClose').click();
                }
            });

        </script>

    @endif
</div>
