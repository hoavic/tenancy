<x-tenapp-layout>

    <x-slot name="title">Chỉnh sửa</x-slot>
    <x-slot name="header">
        <h1 class="app-title">Chỉnh sửa
            <span><a class="m-2 py-1 px-2 inline-block text-gray-600 border border-gray-300 text-sm font-normal rounded" 
                href="{{ route('ten.media.index') }}"><- Trở về Media</a></span>
        </h1>
    </x-slot>

    @if ($media)
        <div class="my-4 flex gap-4">
            <div class="">
                <h2 class="mb-4 font-bold">Tên media: {{ $media->name }}</h2>
                <div>{{ $media }}</div>
                
            </div>
            <div class="w-96">
                <h2 class="font-bold">Chỉnh sửa media</h2>
                <form>
                    <p>
                        <label for="type">Loại</label>
                        <input type="text" id="type" name="type" class="rounded" value="{{ $media->collection_name }}"/>
                    </p>
                    <p>
                        <label for="name">Tên ảnh:</label>
                        <input type="text" id="name" name="name" class="rounded" value="{{ $media->name }}"/>
                    </p>
                    <p>
                        <label for="url">Đường dẫn:</label>
                        <input type="text" id="url" name="url" class="rounded"  value="{{ $media->getUrl() }}"/>
                    </p>
                </form>
            </div>
        </div>
        
    @endif




</x-tenapp-layout>