@props([
    'key',
])

<select 
    {{ $attributes->merge(['class' => 'form-select']) }}

    @if (!empty($key))
        name="{{ $key }}" id={{ $key }} 
    @endif
>
    {{ $slot }}
</select>