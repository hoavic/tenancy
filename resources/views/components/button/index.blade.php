@aware(['left', 'right'])

@props([
  'confirmation',
  'href',
  'type' => 'button',
  'wireKey',
])
 
 @isset ($href)
 <a
   href="{{ $href }}"
   {{ $attributes->merge(['class' => 'btn']) }}

   @isset ($confirmation)
     x-data
     @click.prevent="if (confirm('{{ $confirmation }}')) window.location='{{ $href }}';"
   @endisset

   @isset ($wireKey)
      wire:click.prevent="{{ $wireKey }}"
   @endisset
 >
   {{ $left }}
   {{ $slot }}
   {{ $right }}
 </a>
@else
 <button
   type="{{ $type }}"
   {{ $attributes->merge(['class' => 'btn']) }}

   @isset ($wireKey)
    wire:click.prevent="{{ $wireKey }}"
  @endisset
 >
   {{ $left }}
   {{ $slot }}
   {{ $right }}
 </button>
@endisset