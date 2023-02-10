<x-adminapp-layout>

    <x-slot name="header">
        <h1 class="app-title">Quản lý tài khoản</h1>
    </x-slot>

    @can('create account')

        <div class="my-4 p-8 bg-white rounded-2xl shadow">

            <h2 class="font-bold text-xl text-yellow-600">Tạo tài khoản mới</h2>

            @if ($errors->any())
                <div class="my-4 p-4 bg-gray-100 text-gray-500 rounded-2xl shadow">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (!empty($mess))
                <div class="m-4 p-4 bg-gray-100 text-gray-500 rounded-2xl shadow">
                    <span>{{ $mess }}</span>
                </div>
            @endif

            <form action="{{ route('admin.accounts.store') }}" method="POST">

                @csrf

                <div class="flex gap-4 my-4 items-center">
                    <label class="font-bold">Họ và tên</label>
                    <input class="rounded-2xl" type="text" name="name"/>
                </div>

                <div class="flex gap-4 my-4 items-center">
                    <label class="font-bold">Đại chỉ email</label>
                    <input class="rounded-2xl" type="text" name="email"/>
                </div>

                <div class="my-4">
                    <p class="font-bold">Loại tài khoản</p>

                    <div class="flex gap-4">
                        @if ($roles)
                            @foreach ($roles as $role)

                                <div class="flex gap-4 my-4 items-center">
                                    <input type="checkbox" id="staff-{{ $role->id }}" name="role" value="{{ $role->name }}"/><label for="staff-{{ $role->id }}">{{ $role->name }}</label><span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    

                    <p class=""><a class="text-sm text-gray-500 hover:underline" href="{{ route('admin.roles.index') }}">+ Quản lý loại tài khoản</a></p>

                </div>

                <div class="flex gap-4 my-4 items-center">
                    
                    <input class="py-2 px-6 rounded-lg shadow-2xl uppercase bg-yellow-500 text-white font-bold"
                        type="submit" value="Tạo tài khoản mới"/>
                </div>
            </form>
        </div>
    @endcan

    <h2 class="my-8 font-bold text-xl">Danh sách tài khoản</h2>

    <div class="my-4 p-8 bg-white rounded-2xl shadow">
        <table class="">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th>Loại tài khoản</th>
                    <Th>Trạng thái</Th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>

                @if (empty($accounts))
                    <tr><td colspan="5">Bạn chưa có loại tài khoản nào. Hãy tạo loại tài khoản đầu tiên.</td></tr>
                @endif
                
                @foreach ($accounts as $account)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->email }}</td>
                        <td>
                            
                            @if (isset($account->roles))
                                @foreach ($account->roles as $role)
                                    <span>{{ $role->label }}, </span>
                                @endforeach

                            @else

                                Chưa có

                            @endif
                        </td>
                        <td>
                            <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Ẩn</a>
                            <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Hiện</a>
                            <div>
                                @can('edit account')
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link :href="route('admin.accounts.edit', $account)">
                                                {{ __('Sửa') }}
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('admin.accounts.destroy', $account) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link :href="route('admin.accounts.destroy', $account)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                @endcan

                            </div>
                            <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Xóa</a>
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>

</x-adminapp-layout>




