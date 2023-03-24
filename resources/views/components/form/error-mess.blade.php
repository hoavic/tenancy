
    @if($errors->any())
    <div {{ $attributes->merge(['class' => 'alert error']) }}>
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif




