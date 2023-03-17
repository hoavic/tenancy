@props([
    'wireKey' => null,
    'key',
    'label',
    'row',
    'blankoption',
])

<div 
    
    class="form-row @if(!empty($wireKey)) @error($wireKey) form-row-error @enderror @endif @if (!empty($row)) form-row-{{ $row }} @endif" 
    {{ $attributes }}
    >

    @if (!empty($key) && !empty($label))
        <x-form.label  for="{{ $key }}"> {{ $label }}</x-form.label>
    @endif

    <x-form.select 
        key="{{ $key }}" 
        :wire:model.lazy="$wireKey"
        >
        @if (empty($blankoption) && !empty($label))
            <option value=''>--- Chọn {{ $label }} ---</option>
        @endif
        {{ $slot }}
    </x-form.select>


</div>