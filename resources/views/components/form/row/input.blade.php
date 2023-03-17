@props([
    'wireKey' => null,
    'key',
    'label',
    'type' => 'text',
    'row',
    'required' => false,
    'step' => null,
])

<div 
    
    class="form-row @if(!empty($wireKey)) @error($wireKey) form-row-error @enderror @endif @if (!empty($row)) form-row-{{ $row }} @endif" 
    {{ $attributes }}
    >

    @if (!empty($key) && !empty($label))
        <x-form.label  for="{{ $key }}"> {{ $label }}</x-form.label>
    @endif
    

    <x-form.input :wire:model.lazy="$wireKey" type="{{ $type }}" key="{{ $key }}" :step="$step" :required="$required"></x-form.input>

    {{ $slot }}
    
</div>