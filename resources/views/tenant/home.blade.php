<x-tenguest-layout>
    @php
        $plan = tenant()->subscription()->name;
/*         dd($plan) */
    @endphp
    <p>Tính năng đang được phát triển!</p>
    <h2>Đây là ứng dụng của bạn:</h2>
    <ul>
        <li>Tên miền: {{ tenant()->domains()->first()->domain }}.</li>
        <li>Gói đang dùng: {{ $plan }}</li>
    </ul>
    <h3>Truy cập nhanh:</h3>
    <div class="max-w-96 my-4 mx-auto flex gap-4">
        <a class="inline-block py-2 px-4 bg-gray-900 text-white rounded-full drop-shadow" href="{{ route('ten.login') }}">Đăng nhập</a>
        
        <a class="inline-block py-2 px-4 bg-gray-300 rounded-full drop-shadow" href="{{ route('ten.dashboard') }}">Bảng tin</a>
    </div>
</x-tenguest-layout>