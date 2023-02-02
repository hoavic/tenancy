<x-app-layout>

    <x-slot name="header">
        <h1 class="app-title">Bảng tin</h1>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-200 text-green-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Đăng nhập thành công!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chào mừng bạn đến với <strong>{{ config('app.name') }}</strong>!
            </h2>
        </div>
    </div>



</x-app-layout>
