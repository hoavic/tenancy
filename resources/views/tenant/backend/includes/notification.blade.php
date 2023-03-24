{{-- @if($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert.error>
            {{ $error }}
        </x-alert.error>
    @endforeach
@endif --}}

@if(session()->has('success'))
    <x-notification.success><div>{{ session()->get('success') }}</div></x-notification.success>
@endif

@if(session()->has('error'))
    <x-notification.error><div>{{ session()->get('error') }}</div></x-notification.error>
@endif

@if(session()->has('warning'))
    <x-notification.warning><div>{{ session()->get('warning') }}</div></x-notification.warning>
@endif