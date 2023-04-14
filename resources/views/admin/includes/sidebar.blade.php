<aside 
    x-cloak
    id="sidebar" class="sidebar" >
    <!-- Primary Navigation Menu -->

    <!-- Logo -->

    <div class="sidebar-main">
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

        <!-- PLan & Subs -->
        <div class="block-menu">
            <div class="menu-label">
                <span>Plan & Subs</span>
            </div>
            <!-- Navigation Links -->
            <ul class="menu">
                <li class="nav-item">
                    <x-nav-link :href="route('admin.plans.index')" :active="request()->routeIs('admin.plans.index')">
                        {{ __('Danh sách gói') }}
                    </x-nav-link>
                </li>
                <li class="nav-item"><a class="nav-link" href="#">Quản lý Subs</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Quản lý Plan</a></li>
            </ul>
        </div> 

        <!-- Hỗ trợ -->
        <div class="block-menu">
            <div class="menu-label">
                <span>Danh sách cần hỗ trợ</span>
            </div>
            <!-- Navigation Links -->
            <ul class="menu">
                <li class="nav-item"><a class="nav-link" href="#">Hỗ trợ chung</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Hỗ trợ tên miền</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Hỗ trợ thanh toán</a></li>
            </ul>
        </div>  
    </div>

</aside>
