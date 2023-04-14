<x-adminapp-layout>
    <h2>edit</h2>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('patch')
            <input
                type="text"
                name="name"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                value="{{ old('name', $role->name) }}"
            />
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('admin.roles.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-adminapp-layout>