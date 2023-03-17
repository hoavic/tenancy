@props([
    'wireKey'
])

@aware(['header', 'footer'])

<div {{ $attributes->merge(['class' => 'modal-wrapper']) }}>
    
    <div class="modal-container">
        {{ $header }}
        <div class="modal-body">
            @isset ($wireKey)
                <span class="close-icon" wire:click.prevent="$set('{{ $wireKey }}',false)">X</span>
            @endisset
            {{ $slot }}
        </div>
        {{ $footer }}
    </div>
</div>