<x-new-modal {{ $attributes }} >

    <x-form.error-mess></x-form.error-mess>

    {{ $slot }}

    <x-slot name="footer">
        <x-button.secondary wire:click.prevent="$set('modalShowed', false)">Hủy</x-button.secondary>
        <x-button.primary type="submit" wire:click.prevent="store()">Lưu</x-button.primary>
    </x-slot>

</x-new-modal>