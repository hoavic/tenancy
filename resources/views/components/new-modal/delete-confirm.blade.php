@props([
    'wireKey',
    'maxWidth',
])

<x-new-modal  {{ $attributes }} :wireKey="$wireKey">
    <x-slot name="header">
        <h3>Cảnh báo</h3>
    </x-slot>

    <p>Dữ liệu bị xóa sẽ không thể khôi phục.</p>
    <p>Bạn vẫn muốn tiếp tục?</p>

    <x-slot name="footer">
        <x-button.secondary wireKey="$set('{{ $wireKey }}', false)">Hủy</x-button.secondary>
        <x-button.primary type="submit" wireKey="delete()">Xác nhận</x-button.primary>
    </x-slot>
</x-new-modal>