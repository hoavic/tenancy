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
                    <a href="#">Trang quản trị</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item">Dashboard</li>
                    <li class="menu-item">Thiết lập</li>
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
                    <li class="menu-item">Tất cả bài viết</li>
                    <li class="menu-item">Thêm bài viết mới</li>
                    <li class="menu-item">Chuyên mục</li>
                    <li class="menu-item">Từ khóa</li>
                </ul>
            </div>
        </div>
    </div>
</aside>
