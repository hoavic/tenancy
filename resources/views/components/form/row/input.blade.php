@props([
    'wireKey' => null,
    'key' => null,
    'label',
    'value' => null,
    'type' => 'text',
    'placeholder' => null,
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
    

    <x-form.input 
        :wire:model.lazy="$wireKey" 
        type="{{ $type }}" 
        :key="$key" 
        :step="$step" 
        :required="$required" 
        :value="$value" 
        :placeholder="$placeholder"
        >
    </x-form.input>

    {{ $slot }}
    
</div>