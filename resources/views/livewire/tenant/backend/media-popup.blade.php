<div>
    <p><button wire:click.prevent="doShow()">Thư viện</button></p>
    @if (!empty($show))
        <div x-data="{ tab: $wire.tab }" class="media-model">
            <div class="media-model__top">
                <div class="text-right"><button id="doClose" wire:click.prevent="doClose()">X Đóng</button></div>
                <nav class="media-model__nav">
                    <a class="tab" :class="{ 'active': tab === 'upload' }" x-on:click.prevent="tab = 'upload'" href="#">Tải lên</a>
                    <a class="tab" :class="{ 'active': tab === 'grid' }" x-on:click.prevent="tab = 'grid'" href="#">Thư viện</a>
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
            <div x-show="tab === 'upload'" class="media-model__upload">
                <form wire:submit.prevent="upload" enctype="multipart/form-data">
                    <label for="photo" class="">Đặt ảnh đại diện</label>
                    <input wire:model="photo" id="photo" type="file"
                        accept="image/png, image/jpeg" name="photo">
                    @error('photo') <span class="error">{{ $message }}</span> @enderror
                    <button >Upload</button>
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
                <div x-show="tab === 'grid'" class="media-grid media-model__grid">
                    @foreach ($medias as $media)

                        <a class="media-item" href="{{ route('ten.media.edit', $media->model) }}" target="_blank">
                            <img src="{{ $media->getUrl('thumbnail') }}" alt="{{ $media->name }}" class="" />
                            <span class="media-title">{{ $media->file_name }}</span>
                        </a>
                        
                    @endforeach
                </div>
            @endif
            <div class="media-model__bottom">
                <p class="text-right"><button class="setFeatuedImage">Đặt ảnh đại diện</button></p>
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
