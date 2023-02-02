<aside x-data="{ open: false }" class="sidebar bg-white border-r min-h-screen">
    <!-- Primary Navigation Menu -->
    <div class="">
        <!-- Logo -->
        <div class="text-center p-4 h-16">
            <a class="font-bold text-2xl uppercase text-blue-800" href="{{ route('home') }}">
                AI Bán hàng
            </a>
        </div>
        <div class="flex flex-col">
            <div class="">
                <div class="menu-label">
                    <a href="#">Tổng quan</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item"><a href="{{ route('dashboard') }}">Bảng tin</a></li>
                    <li class="menu-item"><a href="{{ route('setting') }}">Cài đặt chung</a></li>
                </ul>
            </div>

            <!-- Dự án -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Quản lý Dự án</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item"><a href="{{ route('projects.index') }}">Danh sách dự án</a></li>
                    <li class="menu-item">Thiết lập ưu tiên</li>
                </ul>
            </div> 
            
            <!-- Tài khoản -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Tài khoản</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item"><a href="{{ route('profile.edit') }}">Cập nhật thông tin</a></li>
                    <li class="menu-item"><a href="{{ route('profile.pass.edit') }}">Thay đổi Mật khẩu</a></li>
                    <li class="menu-item"><a href="{{ route('profile.del.edit') }}">Xóa tài khoản</a></li>
                </ul>
            </div>

            <!-- Thanh toán -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Thanh toán</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item">Thông tin thanh toán</li>
                    <li class="menu-item">Quản lý thẻ</li>
                    <li class="menu-item">Gói tên miền - hosting</li>
                    <li class="menu-item">Dịch vụ khác</li>
                </ul>
            </div>

            <!-- Hỗ trợ -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Hỗ trợ</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item">Hỗ trợ chung</li>
                    <li class="menu-item">Hỗ trợ tên miền</li>
                    <li class="menu-item">Hỗ trợ thanh toán</li>
                </ul>
            </div>  
        </div>
    </div>
</aside>
