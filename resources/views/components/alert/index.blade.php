@aware(['left', 'right'])

<div
    id="alert-{{ rand(100, 999) }}"
    {{ $attributes->merge(['class' => 'alert']) }}
    x-data="{
        show: true,
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    >
    <span class="close-icon" @click="show = false">X</span>
    {{ $left }}
    {{ $slot }}
    {{ $right }}
</div>

