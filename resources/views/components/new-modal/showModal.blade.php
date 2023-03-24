@props([
    'wireKey',
    'maxWidth',
])

@aware(['header', 'footer'])

<div x-cloak
    id="modal-{{ rand(100, 999) }}"
    {{ $attributes->merge(['class' => 'modal-wrapper']) }}
    
    @isset ($wireKey)
        x-data="{}"
        x-show="$wire.{{ $wireKey }}"
    @endisset

    >
    
    <div class="modal-container @if(!empty($maxWidth)) modal-{{ $maxWidth }} @endif" @click.outside="$wire.{{ $wireKey }} = false">

        @if ($header)
            <div class="modal-header">
                {{ $header }}
            </div>
        @endif

        <div class="modal-body">
            @isset ($wireKey)
                <span class="close-icon" @click="$wire.{{ $wireKey }} = false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </span>
            @endisset
            
            <x-form.error-mess></x-form.error-mess>

            {{ $slot }}
        </div>

        @if ($footer)
            <div class="modal-footer">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>