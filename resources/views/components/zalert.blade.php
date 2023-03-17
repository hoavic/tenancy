<div 
    x-data="{ 
        show: true 
    }"
    x-show="show" 
    x-init="setTimeout(() => show = false, 3000)" 

    class="alert alert-{{ $type }}" role="alert">
    {{ $slot }}
</div>