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

            <!-- Media -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Media</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.media.index')" :active="request()->routeIs('ten.media.index')">
                            {{ __('Thư viện') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.media.create')" :active="request()->routeIs('ten.media.create')">
                            {{ __('Tải lên') }}
                        </x-nav-link>
                    </li>
{{--                     <li class="nav-item">
                        <x-nav-link :href="route('ten.media.api')" :active="request()->routeIs('ten.api.media.index')">
                            {{ __('Api') }}
                        </x-nav-link>
                    </li> --}}
                    
                </ul>
            </div>

            <!-- Sản phẩm -->
            <div class="">
                <div class="menu-label">
                    <a href="#">Sản phẩm</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.products.index')" :active="request()->routeIs('ten.products.index')">
                            {{ __('Tất cả sản phẩm') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.products.create')" :active="request()->routeIs('ten.products.create')">
                            {{ __('Thêm sản phẩm mới') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.product_categories.index')" :active="request()->routeIs('ten.product_categories.index')">
                            {{ __('Danh mục sản phẩm') }}
                        </x-nav-link>
                    </li>
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
