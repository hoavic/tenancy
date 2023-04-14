<x-adminapp-layout>

    <x-slot name="header">
        <h1 class="app-title">Quản lý Gói</h1>
    </x-slot>

    <div class="app-box">
        <h2 class="font-bold text-xl text-yellow-600">Tạo gói mới</h2>

        @if ($errors->any())
            <div class="my-4 p-4 bg-gray-100 text-gray-500 rounded-2xl shadow">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!empty($mess))
            <div class="m-4 p-4 bg-gray-100 text-gray-500 rounded-2xl shadow">
                <span>{{ $mess }}</span>
            </div>
        @endif

        <form action="{{ route('admin.plans.store') }}" method="POST">

            @csrf

            <div class="flex flex-wrap  gap-4 my-4 items-center">
                <label class="font-bold">Đặt tên</label>
                <input class="rounded-2xl" type="text" name="name"/>
            </div>

            <div class="flex flex-wrap gap-4 my-4 items-center">
                
                <input class="py-2 px-6 rounded-lg shadow-2xl uppercase bg-yellow-500 text-white font-bold"
                    type="submit" value="Tạo loại tại khoản mới"/>
            </div>

        </form>
    </div>

    <h2 class="my-8 font-bold text-xl">Danh sách phân loại tài khoản</h2>

    <div class="my-4 p-8 bg-white rounded-2xl shadow">
        <table class="">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên vai trò</th>
                    <th>Tags</th>
                    <th>Giá</th>
                    <th>Phí khởi tạo</th>
                    <th>Chu kỳ</th>
                    <th>Dùng thử</th>
                    <th>Gia hạn</th>  
                </tr>
            </thead>
            <tbody>

                @if (empty($plans))
                    <tr><td colspan="5">Bạn chưa có Gói nào. Hãy tạo Gói đầu tiên.</td></tr>
                @endif
                
                @foreach ($plans as $plan)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $plan->name }}</td>
                        <td>{{ $plan->tag }}</td>
                        <td>{{ $plan->price }} {{ $plan->currency }}</td>
                        <td>{{ $plan->signup_fee }} {{ $plan->currency }}</td>
                        <td>{{ $plan->invoice_period }} {{ $plan->invoice_interval }}</td>
                        <td>{{ $plan->trial_period }} {{ $plan->trial_interval }}</td>
                        <td>{{ $plan->grace_period }} {{ $plan->grace_interval }}</td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>

</x-adminapp-layout>




