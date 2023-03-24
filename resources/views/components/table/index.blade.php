@props([
    'maxWidth',
])

@aware(['thead', 'tfoot'])

<div class="table-responsive">
    <table 
    {{ $attributes->merge(['class' => 'app-table']) }}

    >
    @if ($thead)
        <thead>
            <tr>
                {{ $thead }}
            </tr>
        </thead>     
    @endif

    <tbody>
        {{ $slot }}
    </tbody>

    @if ($tfoot)
        <tfoot>
            <tr>
                {{ $tfoot }}
            </tr>
        </tfoot>     
    @endif
</table>
</div>
