<x-adminapp-layout>

    <x-slot name="header">
        <h1 class="app-title">Quản lý tài khoản</h1>
    </x-slot>

    <div class="app-box">
        <h2 class="font-bold text-xl text-yellow-600">Tạo loại tài khoản mới</h2>

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

        <form action="{{ route('admin.roles.store') }}" method="POST">

            @csrf

            <div class="flex gap-4 my-4 items-center">
                <label class="font-bold">Đặt tên</label>
                <input class="rounded-2xl" type="text" name="name"/>
            </div>

            <div class="my-4">
                <p class="font-bold">Cấp quyền</p>
                <div class="flex gap-4 my-4 items-center">
                    @if ($permissions)
                        @foreach ($permissions as $permission)

                            <div class="flex gap-4 my-4 items-center">
                                <input type="checkbox" id="staff-{{ $permission->id }}" name="permissions" value="{{ $permission->name }}"/><label for="staff-{{ $permission->id }}">{{ $permission->label }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>


                <p class=""><a class="text-sm text-gray-500 hover:underline" href="{{ route('admin.permissions.index') }}">+ Thêm quyền</a></p>

            </div>

            <div class="flex gap-4 my-4 items-center">
                
                <input class="py-2 px-6 rounded-lg shadow-2xl uppercase bg-yellow-500 text-white font-bold"
                    type="submit" value="Tạo loại tại khoản mới"/>
            </div>

        </form>
    </div>

    <h2 class="my-8 font-bold text-xl">Danh sách phân loại tài khoản</h2>

    <div class="my-4 p-8 bg-white rounded-2xl shadow">
        <table class="">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên vai trò</th>
                    <th>Quyền được cấp</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>

                @if (empty($roles))
                    <tr><td colspan="5">Bạn chưa có loại tài khoản nào. Hãy tạo loại tài khoản đầu tiên.</td></tr>
                @endif
                
                @foreach ($roles as $role)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            
                            @if (isset($role->permissions))
                                @foreach ($role->permissions as $permission)
                                    <span>{{ $permission->label }}, </span>
                                @endforeach

                            @else

                                Chưa có

                            @endif
                        </td>
                        <td>
                            <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Ẩn</a>
                            <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Hiện</a>
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
                                        <x-dropdown-link :href="route('admin.roles.edit', $role)">
                                            {{ __('Sửa') }}
                                        </x-dropdown-link>
                                        @can('delete role')
                                            <form method="POST" action="{{ route('admin.roles.destroy', $role) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link :href="route('admin.roles.destroy', $role)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        @endcan

                                    </x-slot>
                                </x-dropdown>
                            @endcan
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>

</x-adminapp-layout>




