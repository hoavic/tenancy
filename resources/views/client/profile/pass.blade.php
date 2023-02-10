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
                    @include('client.profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div>
</x-clientapp-layout>
