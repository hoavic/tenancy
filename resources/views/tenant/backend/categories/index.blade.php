<x-tenapp-layout>

    <x-slot name="title">Danh sách Chuyên mục</x-slot>
    <x-slot name="header">
        <h1 class="app-title">Danh sách Chuyên mục</h1>
    </x-slot>


    <div class="cate-grid">
        <div class="">
            <h2>Thêm chuyên mục</h2>
            <form method="POST" action="{{ route('ten.categories.store') }}">
                @csrf
                <div class="my-4">
                    <label>Tên</label>
                    <input type="text" id="title" name="title" class="block w-full rounded"/>
                </div>

                <div class="my-4">
                    <label>Slug</label>
                    <input type="text" id="slug" name="slug" class="block w-full rounded"/>
                </div>

                <div class="my-4">
                    <label>Danh mục cha</label>
                    <select id="parent_id" name="parent_id" class="block w-full rounded">
                        <option value="0">Không có</option>

                        @if ($categories)
                            @include('tenant.backend.categories.recursive-select', ['categories' => $categories, 'prefix'       => ''])
{{--                             @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->title }}</option>            
                            @endforeach --}}
                            
                        @endif 

                    </select>
                </div>

                <div class="my-4">
                    <label>Mô tả</label>
                    <textarea id="description" name="description" class="block w-full rounded"></textarea>
                </div>

                
                <div class="my-4">
                    <input type="submit" value="Thêm chuyên mục" class="block py-2 px-4 rounded bg-blue-600 text-white"/>                
                </div>
            
            </form>
        </div>
        <div class="">
            <form class="my-4 float-left flex gap-4 items-center">
                <select name="action" class="rounded">
                    <option>Hành động</option>
                    <option value="delete">Xóa</option>
                </select>
                <input class="inline-block py-2 px-4 bg-blue-600 text-white rounded" type="submit" value="Áp dụng"/>
            </form>
            <table class="table border w-full bg-white shadow">
                <thead class="text-left">
                    <tr class="border-b border-gray-300">
                        <th><input type="checkbox" name="" class="rounded"/></th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Slug</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories)
                        @include('tenant.backend.categories.recursive', [
                                'categories' => $categories,
                                'prefix'       => '',
                            ])  
                    @endif 
                </tbody>
            </table>
        </div>
    </div>



</x-tenapp-layout>