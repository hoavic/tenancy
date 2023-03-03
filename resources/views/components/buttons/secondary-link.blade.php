<a {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block px-2 bg-white text-blue-600 text-base font-normal border border-blue-600 rounded']) }}>
    {{ $slot }}
</a>