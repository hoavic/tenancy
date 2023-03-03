<x-tenapp-layout>

    <x-slot name="title">Danh sách Media</x-slot>
    <x-slot name="header">
        <h1 class="app-title">Media
            <span><a class="m-2 py-1 px-2 inline-block text-blue-600 border border-blue-600 text-sm font-normal rounded" 
                href="{{ route('ten.posts.create') }}">Thêm media mới</a></span>
        </h1>
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