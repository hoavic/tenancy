@props([
    'key',
])

<input 
    {{ $attributes->merge(['class' => 'form-input']) }}

    @if (!empty($key))
        name="{{ $key }}" id={{ $key }} 
    @endif
    
/>