@props([
    'wireKey',
    'maxWidth',
])

@aware(['header', 'footer'])

<div {{ $attributes->merge(['class' => 'modal-wrapper']) }}
    
    @isset ($wireKey)
        x-data="{}"
       {{--  x-show="$wire.{{ $wireKey }}" --}}
    @endisset

    >
    
    <div class="modal-container @if(!empty($maxWidth)) modal-{{ $maxWidth }} @endif" @click.outside="$wire.{{ $wireKey }} = false">
        {{ $header }}
        <div class="modal-body">
            @isset ($wireKey)
                <span class="close-icon" @click="$wire.{{ $wireKey }} = false">X</span>
            @endisset
            {{ $slot }}
        </div>
        {{ $footer }}
    </div>
</div>