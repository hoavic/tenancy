<a {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block px-2 bg-blue-600 text-white text-base font-normal rounded']) }}>
    {{ $slot }}
</a>