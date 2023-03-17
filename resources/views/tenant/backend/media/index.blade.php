<x-tenapp-layout>

    <x-slot name="title">Danh sách Media</x-slot>
    <x-slot name="header">Media</x-slot>
    <x-slot name="header_button">
        <x-button.secondary href="{{ route('ten.media.create') }}">Thêm media mới</x-button.secondary>
    </x-slot>

    <div class="my-4 media-grid">
        @if ($medias)
            @foreach ($medias as $media)

                <a class="media-item" href="{{ route('ten.media.edit', $media->model) }}">
                   {{--  <img src="{{ $media->getUrl('thumbnail') }}" alt="{{ $media->name }}" class="" /> --}}
                    <img src="{{ $media->getUrl('thumbnail') }}" alt="{{ $media->name }}" class="" />
                    <span class="media-title">{{ $media->file_name }}</span>
                </a>
                
            @endforeach
        @endif
    </div>

</x-tenapp-layout>