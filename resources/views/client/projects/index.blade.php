<x-clientapp-layout>

    <x-slot name="header">
        <h1 class="app-title">Danh sách dự án</h1>
    </x-slot>

    <div class="my-4 p-8 bg-white rounded-2xl shadow">
        <h2 class="font-bold text-xl text-yellow-600">Tạo dự án mới</h2>

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

        <form action="{{ route('client.projects.store') }}" method="POST">

            @csrf

            <div class="flex gap-4 my-4 items-center">
                <label class="font-bold">Nhập vào tên dự án</label>
                <input class="rounded-2xl" type="text" name="project_name"/>
            </div>

            <div class="flex gap-4 my-4 items-center">
                <span class="font-bold">Chọn loại tên miền</span>
                <input type="radio" id="subdomain" name="domain_type" value="subdomain" checked/><label for="subdomain">Subdomain - Miễn phí</label>
                <span>|</span>
                <input type="radio"  id="domain" name="domain_type" value="domain"/><label for="domain">Domain riêng</label>
            </div>

            <div class="flex gap-4 my-4 items-center">
                <label class="font-bold">Tên miền</label>
                <input class="rounded-2xl" type="text" name="project_domain"/>
            </div>

            <div class="flex gap-4 my-4 items-center">
                <span class="font-bold">Chọn gói:</span>
                <input type="radio" id="free" name="plan" value="free" checked/><label for="free"><strong>Cơ bản (Miễn phí)</strong></label>
                <span>|</span>
                <input type="radio"  id="startup" name="plan" value="startup"/><label for="startup">Startup (1$/tháng)</label>
                <span>|</span>
                <input type="radio"  id="higher" name="plan" value="higher"/><label for="higher">Higher (5$/tháng)</label>
                <span>|</span>
                <input type="radio"  id="professional" name="plan" value="professional"/><label for="professional">Professional (9$/tháng)</label>
            </div>

            <div class="flex gap-4 my-4 items-center">
                
                <input class="py-2 px-6 rounded-lg shadow-2xl uppercase bg-yellow-500 text-white font-bold"
                    type="submit" value="Tạo dự án"/>
            </div>

            <div class="my-4">
                <p class="text-md text-gray-600">Số lượng dự án tối đa có thể khởi tại là: 2</p>
                <p class="text-md text-gray-600">Tài khoản mặc định: email hiện tại  -  Mật khẩu mặc định: doimatkhaumacdinh</p>
            </div>
        </form>
    </div>

    <h2 class="my-8 font-bold text-xl">Danh sách Tenancy</h2>

    <div class="my-4 p-8 bg-white rounded-2xl shadow">
        <table class="">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên dự án</th>
                    <th>Địa chỉ</th>
                    <th>Tình trạng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
{{--                 <tr>
                    <td>1</td>
                    <td>Dự án demo</td>
                    <td><a href="https://foo.tenancy.test" target="_blank">foo.tenancy.test</a></td>
                    <td>Hoạt động</td>
                    <td>
                        <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Ẩn</a>
                        <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Hiện</a>
                        <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Xóa</a>
                    </td>
                </tr> --}}

                @if (empty($tenants))
                    <tr><td colspan="5">Bạn chưa có dự án nào. Hãy tạo dự án đầu tiên.</td></tr>
                @endif
                
                @foreach ($tenants as $tenant)
                    {{-- {{ dd($tenant) }} --}}
                    @php
                        $domain = App\Http\Controllers\ProjectController::getDomain($tenant->id);
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tenant->name }}</td>
                        <td><a href="{{ $domain }}" target="_blank">{{ $domain }}</a></td>
                        <td>Hoạt động</td>
                        <td>
                            <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Ẩn</a>
                            <a href="#" class="p-2 inline-block bg-gray-200 text-gray-500 font-bold text-sm shadow rounded-2xl">Hiện</a>
                            @can('edit project')
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('client.projects.edit', $tenant)">
                                        {{ __('Sửa') }}
                                    </x-dropdown-link>
                                    @can('delete project')
                                        <form method="POST" action="{{ route('client.projects.destroy', $tenant) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('client.projects.destroy', $tenant)" onclick="event.preventDefault(); this.closest('form').submit();">
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

{{--                 @foreach ($domains as $domain)
                    {{ dd($domain) }}
    

                @endforeach --}}

            </tbody>
        </table>
    </div>
    <p></p>

</x-clientapp-layout>




