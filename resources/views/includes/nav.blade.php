<nav x-data="{ open: false }" class="action-nav">
    <!-- Navigation Links -->
    <ul class="flex items-center">
        @auth
            <li class="top-item nav-item">
                <x-nav-link :href="route('dashboard')" :active="request()->route()->getPrefix() === '/ai-client'">
                    {{ __('Trang khách hàng') }}
                </x-nav-link>
            </li>
        @endauth

        @role('Super Admin|Admin|Manager')
            <li class="top-item nav-item">
                <x-nav-link :href="route('admin.dashboard')" :active="request()->route()->getPrefix() === '/ai-admin'">
                    {{ __('Trang Admin') }}
                </x-nav-link>
            </li>
        @endrole
        
        <li class="top-item nav-item"><a href="">Tính tiền</a></li>
    </ul>


    <!-- Settings Dropdown -->
    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <x-dropdown width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md 
                        transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Tài khoản') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Đăng xuất') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>

</nav>
