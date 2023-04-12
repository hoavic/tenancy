<aside class="sidebar" x-cloak>
    <!-- Primary Navigation Menu -->
    
        <div class="sidebar-main">
            <div class="block-menu">
                <div class="menu-label">
                    <span>Tổng quan</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('client.dashboard')" :active="request()->routeIs('client.dashboard')">
                            {{ __('Bảng tin') }}
                        </x-nav-link>
                    </li>
{{--                     <li class="nav-item">
                        <x-nav-link :href="route('client.setting')" :active="request()->routeIs('client.setting')">
                            {{ __('Cài đặt chung') }}
                        </x-nav-link>
                    </li> --}}
                </ul>
            </div>

            <!-- Dự án -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Quản lý Dự án</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('client.projects.index')" :active="request()->routeIs('client.projects.index')">
                            {{ __('Danh sách dự án') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Thiết lập ưu tiên</a></li>
                </ul>
            </div> 

            <!-- Thanh toán -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Thanh toán</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item"><a class="nav-link" href="#">Thông tin thanh toán</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Quản lý thẻ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Dịch vụ khác</a></li>
                </ul>
            </div>

            <!-- Hỗ trợ -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Hỗ trợ</span>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item"><a class="nav-link" href="#">Hỗ trợ chung</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Hỗ trợ tên miền</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Hỗ trợ thanh toán</a></li>
                </ul>
            </div>  

            <!-- Tài khoản -->
            <div class="block-menu">
                <div class="menu-label">
                    <span>Thông tin tài khoản</span>
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
            
        </div>

</aside>
