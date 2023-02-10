<x-clientapp-layout>
    <x-slot name="header">
        <h1 class="app-title">
            {{ __('Quản lý Tài khoản') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('client.profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2">
            
            <a href="{{ route('profile.pass.edit') }}" 
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Cập nhật Mật khẩu
            </a>
            <a href="{{ route('profile.del.edit') }}" 
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Xóa tài khoản
            </a>

        </div>
    </div>

</x-clientapp-layout>
