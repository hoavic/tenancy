<aside x-data="{ open: false }" class="sidebar">
    <!-- Primary Navigation Menu -->
    <div class="">
        <!-- Logo -->
        <div class="text-center p-4 h-16">
            <a class="font-bold text-2xl uppercase text-blue-800" href="{{ route('home') }}">
                AI Bán hàng
            </a>
        </div>
        <div class="flex flex-col">
            <div class="block-menu">
                <div class="menu-label">
                    <span>Tổng quan</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Bảng tin') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Cài đặt chung</a>
                    </li>
                </ul>
            </div>

            <!-- Vai trò & Quyền -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Vai trò & Quyền</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('admin.roles.index')" :active="request()->routeIs('admin.roles.index')">
                            {{ __('Vai trò') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('admin.permissions.index')" :active="request()->routeIs('admin.permissions.index')">
                            {{ __('Quyền') }}
                        </x-nav-link>
                    </li>
                </ul>
            </div> 

            <!-- Dự án -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Quản lý tài khoản</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('admin.accounts.index')" :active="request()->routeIs('admin.accounts.index')">
                            {{ __('Danh sách Tài khoản') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Thiết lập Quyền</a></li>
                </ul>
            </div> 
            
            <!-- Tài khoản -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Tài khoản của tôi</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                            {{ __('Cập nhật thông tin') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('profile.pass.edit')" :active="request()->routeIs('profile.pass.edit')">
                            {{ __('Thay đổi Mật khẩu') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('profile.del.edit')" :active="request()->routeIs('profile.del.edit')">
                            {{ __('Xóa tài khoản') }}
                        </x-nav-link>
                    </li>
                </ul>
            </div>


            <!-- Hỗ trợ -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Yêu cầu Hỗ trợ</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item"><a class="nav-link" href="#">Hỗ trợ chung</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Hỗ trợ tên miền</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Hỗ trợ thanh toán</a></li>
                </ul>
            </div>  
        </div>
    </div>
</aside>
