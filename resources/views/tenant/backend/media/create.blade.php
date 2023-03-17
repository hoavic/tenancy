<x-tenapp-layout>

    <x-slot name="title">Tải lên Media</x-slot>
    <x-slot name="header">Tải lên</x-slot>
    <x-slot name="header_button">
        <x-button href="{{ route('ten.media.index') }}">< Trở về</x-button>
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