<x-clientapp-layout>

    @php
        $user = Auth::user();
    @endphp

    <x-slot name="header">
        <h1 class="app-title">Xin chào {{ $user->name }}!</h1>
    </x-slot>

    <section   
        x-data="{showWelcome: true}"
        x-show="showWelcome"
        class="p-4 mb-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl drop-shadow">
        <button @click="showWelcome = false" class="absolute top-2 right-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-gray-300" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="flex flex-wrap md:gap-4 items-center xl:py-8">
            <div class="w-full md:w-1/3 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="m-auto h-24 fill-blue-200" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <div class="">
                    <h2 class="text-xl">Chào mừng bạn đến với <strong class="text-blue-800">{{ config('app.name') }}</strong>! Hãy xem hướng dẫn khởi tạo và tăng tốc kinh doanh của bạn!</h2>
                    <p>Nếu đây là lần đầu bạn đăng nhập, hãy làm theo hướng dẫn để cá nhân hóa dự án theo sở thích của bạn.</p>
                </div>
                <div class="">
                    <button class="block my-4 py-2 px-8 bg-blue-600 text-white rounded-full drop-shadow">Bắt đầu!</button>
                </div>
                
            </div>
        </div>
    </section>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                
            </h2>
        </div>
    </div>



</x-clientapp-layout>
