<nav 
    :class="{ 'block shadow-3xl': showNav, 'hidden': !showNav }"
    x-show.transition="true"
    
    class="site-navigation" x-cloak>
    <!-- Navigation Links -->
    <ul id="primary-menu" class="menu main-menu">
        
        <li class="menu-item"><a href="#">Giới thiệu</a></li>

        <li class="menu-item menu-item-has-children">
            <a href="#">Tính năng</a>
            <ul class="sub-menu">
                <li class="menu-item"><a href="#">Quản lý kho</a></li>
                <li class="menu-item"><a href="#">Phần mềm tính tiền</a></li>
                <li class="menu-item"><a href="#">Website, bán hàng online</a></li>
            </ul>
        </li>

        <li class="menu-item"><a href="#">Giá</a></li>
        <li class="menu-item"><a href="#">Hiệu quả</a></li>

    </ul>

    <ul class="menu nav-action">
        @auth
            <li><a href="{{ route('client.dashboard') }}" class="inline-block text-sm text-center rounded-full hover:shadow-md hover:shadow-[#0c66ee]/50 transition duration-300 px-8 xl:px-10 py-3 text-white bg-gradient-to-r from-[#468ef9] to-[#0c66ee] text-white">Bảng tin</a></li>
        @else
            <li><a href="{{ route('login') }}" class="inline-block text-sm text-center rounded-full hover:shadow-md hover:shadow-[#0c66ee]/50 transition duration-300 px-8 xl:px-10 py-3 bg-inherit text-blue-600 border border-[#0c66ee]">Đăng nhập</a></li>

            @if (Route::has('register'))
                <li><a href="{{ route('register') }}" class="inline-block text-sm text-center rounded-full hover:shadow-md hover:shadow-[#0c66ee]/50 transition duration-300 px-8 xl:px-10 py-3 text-white bg-gradient-to-r from-[#468ef9] to-[#0c66ee] text-white">Đăng ký</a></li>
            @endif
        @endauth
    </ul>

</nav>
