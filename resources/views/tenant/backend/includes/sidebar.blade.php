<aside x-data="{ open: false }" class="sidebar bg-white border-r min-h-screen">
    <!-- Primary Navigation Menu -->
    <div class="">
        <!-- Logo -->
        <div class="text-center p-4 h-16">
            <a class="font-bold text-2xl uppercase text-blue-800" href="{{ route('home') }}">
                WEB ADMIN
            </a>
        </div>
        <div class="flex flex-col">
            <div class="">
                <div class="menu-label">
                    <a href="#">Trang quản trị</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item"><a href="{{ route('ten.dashboard') }}">Bảng tin</a></li>
                    <li class="menu-item"><a href="{{ route('ten.setting') }}">Thiết lập</a></li>
                </ul>
            </div>

            <div class="">
                <div class="menu-label">
                    <a href="#">Giao diện</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item"><a href="{{ route('ten.dashboard') }}">Quản lý giao diện</a></li>
                    <li class="menu-item"><a href="{{ route('ten.setting') }}">Chỉnh sửa</a></li>
                </ul>
            </div>

            <!-- Sản phẩm -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Sản phẩm</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item">Tất cả sản phẩm</li>
                    <li class="menu-item">Thêm sản phẩm mới</li>
                    <li class="menu-item">Danh mục</li>
                    <li class="menu-item">Từ khóa</li>
                </ul>
            </div>

            <!-- Đơn hàng -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Quản lý Đơn hàng</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item">Tất cả đơn hàng</li>
                    <li class="menu-item">Thống kê</li>
                </ul>
            </div>

            <!-- Kho hàng -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Quản lý Kho hàng</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item">Tồn kho</li>
                    <li class="menu-item">Thu - Chi</li>
                    <li class="menu-item">Công nợ</li>
                </ul>
            </div>

            <!-- Bài viết -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Bài viết</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item"><a href="{{ route('ten.posts.index') }}">Tất cả bài viết</a></li>
                    <li class="menu-item"><a href="{{ route('ten.posts.create') }}">Thêm bài viết mới</a></li>
                    <li class="menu-item"><a href="{{ route('ten.categories.index') }}">Chuyên mục</a></li>
                    <li class="menu-item">Từ khóa</li>
                </ul>
            </div>

            <!-- Tài khoản -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Tài khoản</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item"><a href="{{ route('ten.profile.edit') }}">Cập nhật thông tin</a></li>
                    <li class="menu-item"><a href="{{ route('ten.profile.pass.edit') }}">Thay đổi Mật khẩu</a></li>
                    <li class="menu-item"><a href="{{ route('ten.profile.del.edit') }}">Xóa tài khoản</a></li>
                </ul>
            </div>
        </div>
    </div>
</aside>
