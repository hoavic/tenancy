<aside x-data="{ open: false }" class="sidebar min-h-screen">
    <!-- Primary Navigation Menu -->
    <div class="">
        <!-- Logo -->
        <div class="text-center p-4 h-16">
            <a class="font-bold text-2xl uppercase text-blue-800" href="{{ route('dashboard') }}">
                Trang Client
            </a>
        </div>
        <div class="flex flex-col">
            <div class="block-menu">
                <div class="menu-label">
                    <span>Tổng quan</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Bảng tin') }}
                        </x-nav-link>
                    </li>
                    <li class="menu-item">
                        <x-nav-link :href="route('setting')" :active="request()->routeIs('setting')">
                            {{ __('Cài đặt chung') }}
                        </x-nav-link>
                    </li>
                </ul>
            </div>

            <!-- Dự án -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Quản lý Dự án</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item">
                        <x-nav-link :href="route('client.projects.index')" :active="request()->routeIs('client.projects.index')">
                            {{ __('Danh sách dự án') }}
                        </x-nav-link>
                    </li>
                    <li class="menu-item"><a class="nav-link" href="#">Thiết lập ưu tiên</a></li>
                </ul>
            </div> 
            
            <!-- Tài khoản -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Tài khoản</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item">
                        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                            {{ __('Cập nhật thông tin') }}
                        </x-nav-link>
                    </li>
                    <li class="menu-item">
                        <x-nav-link :href="route('profile.pass.edit')" :active="request()->routeIs('profile.pass.edit')">
                            {{ __('Thay đổi Mật khẩu') }}
                        </x-nav-link>
                    </li>
                    <li class="menu-item">
                        <x-nav-link :href="route('profile.del.edit')" :active="request()->routeIs('profile.del.edit')">
                            {{ __('Xóa tài khoản') }}
                        </x-nav-link>
                    </li>
                </ul>
            </div>

            <!-- Thanh toán -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Thanh toán</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item"><a class="nav-link" href="#">Thông tin thanh toán</a></li>
                    <li class="menu-item"><a class="nav-link" href="#">Quản lý thẻ</a></li>
                    <li class="menu-item"><a class="nav-link" href="#">Gói tên miền - hosting</a></li>
                    <li class="menu-item"><a class="nav-link" href="#">Dịch vụ khác</a></li>
                </ul>
            </div>

            <!-- Hỗ trợ -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Hỗ trợ</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="menu-item"><a class="nav-link" href="#">Hỗ trợ chung</a></li>
                    <li class="menu-item"><a class="nav-link" href="#">Hỗ trợ tên miền</a></li>
                    <li class="menu-item"><a class="nav-link" href="#">Hỗ trợ thanh toán</a></li>
                </ul>
            </div>  
        </div>
    </div>
</aside>
