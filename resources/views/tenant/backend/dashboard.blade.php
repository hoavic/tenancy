<x-tenapp-layout>
    <x-slot name="header">{{ __('Bảng tin') }}</x-slot>

    <div class="">
        <x-notification.warning>
            <h2>Chào mừng bạn đến với AI BÁn hàng!</h2>
        </x-notification.warning>
        <div class="block">
            <h2>Truy cập nhanh các sản phẩm</h2>
            <div class="grid grid-cols-4 gap-4">
                <a href="#" class="h-44 w-full bg-blue-600 text-white rounded shadow-2xl flex justify-center items-center">
                    <span class="font-bold">Quản lý Website</span>
                </a>
                <a href="#" class="h-44 w-full bg-emerald-500 text-white rounded shadow-2xl flex justify-center items-center">
                    <span class="font-bold">Phần mềm tính tiền</span>
                </a>
                <a href="#" class="h-44 w-full bg-indigo-500 text-white rounded shadow-2xl flex justify-center items-center">
                    <span class="font-bold">Quản lý Kho hàng</span>
                </a>
                <a href="#" class="h-44 w-full bg-amber-600 text-white rounded shadow-2xl flex justify-center items-center">
                    <span class="font-bold">Báo cáo bán hàng</span>
                </a>
            </div>
        </div>

        <div class="block">
            <h2>Doanh số bán hàng</h2>
            <div class="grid grid-cols-2 gap-4">
                <div  class="h-60 w-full bg-teal-100 text-gray-600 rounded shadow-2xl flex justify-center items-center">
                    <span class="font-bold">Doanh số bán hàng</span>
                </div>
                <div class="h-60 w-full bg-rose-100 text-gray-600 rounded shadow-2xl flex justify-center items-center">
                    <span class="font-bold">Tổng số đơn hàng</span>
                </div>
            </div>
        </div>

        <div class="block">
            <h2>Đơn hàng mới nhất</h2>
            <table class="my-4 bg-gray-100 shadow">
                <thead class="bg-gray-300">
                    <tr>
                        <th>#</th>
                        <th>Mã hàng</th>
                        <th>Thời gian</th>
                        <th>Số bill</th>
                        <th>Nhân viên</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>SKU0021</td>
                        <td>2023-03-08 12:09</td>
                        <td>B213</td>
                        <td>Nguyen Thi Mai</td>
                        <td>10.234.000đ</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</x-tenapp-layout>
