@props([
    'wireKey',
    'key',
    'label',
    'type' => 'text',
    'row',
])

<div 
    
    class="form-row @if(!empty($wireKey)) @error($wireKey) form-row-error @enderror @endif @if (!empty($row)) form-row-{{ $row }} @endif" 
    {{ $attributes }}
    >

    @if (!empty($key) && !empty($label))
        <x-form.label  for="{{ $key }}"> {{ $label }}</x-form.label>
    @endif
    
    {{ $slot }}

</div>