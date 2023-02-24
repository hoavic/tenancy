<div>
    <div style="text-align: center">
        <button wire:click="increment">+</button>
        <h1>{{ $count }}</h1>
    </div>

    @if ($errors->any())
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif

    {{-- @include('livewire.tenant.backend.post-form.create') --}}
    
    @if(!$title)
        @include('livewire.tenant.backend.post-form.create')
    @else
        @include('livewire.tenant.backend.post-form.update')
    @endif

</div>
