<x-adminapp-layout>

    <x-slot name="header">
        <h1 class="app-title">Quản lý quyền</h1>
    </x-slot>

    <div class="my-4 p-8 bg-white rounded-2xl shadow">
        <h2 class="font-bold text-xl text-yellow-600">Tạo quyền mới</h2>

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

        <form action="{{ route('admin.permissions.store') }}" method="POST">

            @csrf

            <div class="flex gap-4 my-4 items-center">
                <label class="font-bold">Nhãn</label>
                <input class="rounded-2xl" type="text" name="label"/>
            </div>

            <div class="flex gap-4 my-4 items-center">
                <label class="font-bold">Quyền</label>
                <input class="rounded-2xl" type="text" name="name"/>
            </div>

            <div class="my-4 ">
                <p class="font-bold">Đính kèm với loại tài khoản:</p>
                <div class="flex gap-4 items-center">    
                    @if ($roles)
                        @foreach ($roles as $role)
                            <input type="checkbox" id="role-{{ $role->id }}" name="role" value="{{ $role->id }}"/><label for="role-{{ $role->id }}">{{ $role->name }}</label>
                        @endforeach
                    @endif
                </div>
                <p class=""><a class="text-sm text-gray-500 hover:underline" href="{{ route('admin.roles.index') }}">+ Thêm loại tài khoản</a></p>
            </div>

            

            <div class="flex gap-4 my-4 items-center">
                
                <input class="py-2 px-6 rounded-lg shadow-2xl uppercase bg-yellow-500 text-white font-bold"
                    type="submit" value="Tạo quyền mới"/>
            </div>

        </form>
    </div>

    <h2 class="my-8 font-bold text-xl">Danh sách các quyền đã tạo</h2>

    <div class="my-4 p-8 bg-white rounded-2xl shadow">
        <table class="">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nhãn</th>
                    <th>Quyền</th>
                    <th>Tài khoản đính kèm</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>

                @if (empty($permissions))
                    <tr><td colspan="5">Bạn chưa có quyền nào. Hãy tạo quyền đầu tiên.</td></tr>
                @endif
                
                @foreach ($permissions as $permission)
                   {{--  {{ dd($role) }} --}}
                    @php
                        /* $permission = App\Http\Controllers\Admin\ProjectController::getPermission($role->id); */
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $permission->label }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            @if (isset($permission->roles))
                                @foreach ($permission->roles as $role)
                                    <span>{{ $role->name }}, </span>
                                @endforeach
                            @else
                                Chưa có
                            @endif
                        </td>
                        <td>
                            <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Ẩn</a>
                            <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Hiện</a>
                            
                            @role('Super Admin')
                                <x-dropdown>

                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('admin.permissions.edit', $permission)">
                                            {{ __('Chỉnh sửa') }}
                                        </x-dropdown-link>
                                       
                                        <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('admin.permissions.destroy', $permission)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Xóa') }}
                                            </x-dropdown-link>
                                        </form>

                                    </x-slot>
                                </x-dropdown>
                            @endrole
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>

</x-adminapp-layout>




