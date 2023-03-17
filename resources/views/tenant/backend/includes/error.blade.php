@if ($errors->any())

{{-- {{ dd($errors) }} --}}
    <x-alert.error>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert.error>
@endif