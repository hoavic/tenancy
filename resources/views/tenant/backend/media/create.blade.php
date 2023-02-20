<x-tenapp-layout>

    <x-slot name="title">Tải lên</x-slot>
    <x-slot name="header">
        <h1 class="app-title">Tải lên
            <span><a class="m-2 py-1 px-2 inline-block text-gray-600 border border-gray-300 text-sm font-normal rounded" 
                href="{{ route('ten.media.store') }}"><- Trở về Media</a></span>
        </h1>
    </x-slot>

   
        <form method="POST" action="{{ route('ten.media.store') }}" class="my-4 flex gap-4" enctype="multipart/form-data">
            @csrf
            <div class="">
                <label class="mb-4 font-bold">Chọn media: </label>
                <input type="file" id="file" name="file"/>
                
                <input type="submit" value="Tải lên"/>
            </div>
        </form>
        





</x-tenapp-layout>