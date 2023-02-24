@if ($medias)
@foreach ($medias as $media)

    <a class="media-item" href="{{ route('ten.media.edit', $media->model) }}">
        <img src="{{ $media->getUrl('thumbnail') }}" alt="{{ $media->name }}" class="" />
        <span class="media-title">{{ $media->file_name }}</span>
    </a>
    
@endforeach
@endif