<div x-data="{ 
        show: true 
    }"
    x-show="show" 
    x-init="setTimeout(() => show = false, 30000)" 
    class="notification {{ $type }}"
    role="alert">
    <div class="notification-content">
        <span class="icon"></span>
        <div class="notification-text">
            {{ $message }}
        </div>
    </div>
    <span class="close" @click="show = false">X</span>
</div>