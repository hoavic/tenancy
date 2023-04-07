<aside id="sidebar" x-data="{ open: false }" class="sidebar">
    <!-- Primary Navigation Menu -->

        <!-- Logo -->
        <div class="sidebar-header">
            <a class="font-bold text-2xl uppercase text-blue-800" href="{{ route('home') }}">
                WEB ADMIN
            </a>
        </div>
        <div class="sidebar-main">
            <div class="block-menu">
                <div class="menu-label">
                    <a href="#">Trang quản trị</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.dashboard')" :active="request()->routeIs('ten.dashboard')">
                            {{ __('Bảng tin') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.setting')" :active="request()->routeIs('ten.setting')">
                            {{ __('Cài đặt') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.reporting')" :active="request()->routeIs('ten.reporting')">
                            {{ __('Báo cáo') }}
                        </x-nav-link>
                    </li>
                </ul>
            </div>

            <!-- Sản phẩm -->
            <div class="block-menu">
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
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.brands.index')" :active="request()->routeIs('ten.brands.index')">
                            {{ __('Thương hiệu') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.attributes.index')" :active="request()->routeIs('ten.attributes.index')">
                            {{ __('Thuộc tính') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Từ khóa <x-html.comming-soon/></a></li>
                </ul>
            </div>

            <!-- Địa điểm -->
            <div class="block-menu">
                <div class="menu-label">
                    <a href="{{ route('ten.location') }}">Quản lý Kho</a>
                </div>
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.inventory')" :active="request()->routeIs('ten.inventory')">
                            {{ __('Tồn kho') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.location')" :active="request()->routeIs('ten.location')">
                            {{ __('Quản lý Địa điểm') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.supplier')" :active="request()->routeIs('ten.supplier')">
                            {{ __('Nhà cung cấp') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.purchase')" :active="request()->routeIs('ten.purchase')">
                            {{ __('Nhập hàng') }}
                        </x-nav-link>
                    </li>

                    <li class="nav-item"><a href="#" class="nav-link">Thu - Chi <x-html.comming-soon/></a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Công nợ <x-html.comming-soon/></a></li>
                </ul>
            </div>

            <!-- Đơn hàng -->
            <div class="block-menu">
                <div class="menu-label">
                    <a href="#">Quản lý Đơn hàng</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.order')" :active="request()->routeIs('ten.order')">
                            {{ __('Tất cả đơn hàng') }}
                        </x-nav-link>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link">Thống kê <x-html.comming-soon/></a></li>
                    <li class="nav-item">
                        <x-nav-link :href="route('ten.pos')" :active="request()->routeIs('ten.pos')">
                            {{ __('POS') }}
                        </x-nav-link>
                    </li>
                </ul>
            </div>

            <!-- Bài viết -->
            <div class="block-menu">
                <div class="menu-label">
                    <a href="#">Bài viết</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('ten.posts.index') }}">Tất cả bài viết</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ten.posts.create') }}">Thêm bài viết mới</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ten.categories.index') }}">Chuyên mục</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Từ khóa <x-html.comming-soon/></a></li>
                </ul>
            </div>

            
            <div class="block-menu">
                <div class="menu-label">
                    <a href="#">Giao diện</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('ten.dashboard') }}">Quản lý giao diện <x-html.comming-soon/></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ten.setting') }}">Chỉnh sửa <x-html.comming-soon/></a></li>
                </ul>
            </div>

            <!-- Media -->
            <div class="block-menu">
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

            <!-- Tài khoản -->
            <div class="block-menu">
                <div class="menu-label">
                    <a href="#">Quản lý tài khoản</a>
                </div>
                <!-- Navigation Links -->
                <ul class="menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('ten.profile.edit') }}">Danh sách tài khoản <x-html.comming-soon/></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ten.profile.pass.edit') }}">Quản lý vai trò <x-html.comming-soon/></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('ten.profile.del.edit') }}">Quản lý quền <x-html.comming-soon/></a></li>
                </ul>
            </div>
        </div>

</aside>
