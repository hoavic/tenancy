<x-tenguest-layout>
    <h2>This is your multi-tenant application. The id of the current tenant is {{ tenant()->domains()->first()->domain }}</h2>
    <h1>Trang chủ</h1>
    <div class="max-w-96 mx-auto p-4 flex gap-4">
        <a href="{{ route('ten.dashboard') }}">Bang tin</a>
        <a href="{{ route('ten.login') }}">Login</a>
    </div>
</x-tenguest-layout>