@aware(['left', 'right'])

<div
    id="noti-{{ rand(100, 999) }}"
    {{ $attributes->merge(['class' => 'notification']) }}
    x-data="{
        showNoti: true,
    }"
    x-init="setTimeout(() => showNoti = false, 3000)"
    x-show="showNoti"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    >
    <span class="close-icon" @click="showNoti = false">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </span>
    {{ $left }}
    {{ $slot }}
    {{ $right }}
</div>

