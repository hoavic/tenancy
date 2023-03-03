<x-tenapp-layout>

    <x-slot name="title">Danh sách bài viết</x-slot>
    <x-slot name="header">
        <h1 class="app-title">Danh sách bài viết 
            <span><a class="m-2 py-1 px-2 inline-block text-blue-600 border border-blue-600 text-sm font-normal rounded" 
                href="{{ route('ten.posts.create') }}">Viết bài mới</a></span>
        </h1>
    </x-slot>


    <table class="">
        <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Chuyên mục</th>
                <th>Từ khóa</th>
                <th>Thời gian</th>
            </tr>
        </thead>
        <tbody>
            @if ($posts)

                @foreach ($posts as $post)
                    {{-- {{ dd($post) }} --}}
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="has-sub">
                            {{ $post->title }}
                            <div class="sub-item">
                                <a href="{{ route('ten.posts.edit', $post) }}">Chỉnh sửa</a> 
                                <form method="POST" action="{{ route('ten.posts.destroy', $post) }}">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('ten.posts.destroy', $post) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Xóa') }}
                                    </a>
                                </form>
                            </div></td>
                        </td>
                        <td>{{ $post->user_id }}</td>
                        <td>
                            
                                <img src="{{ $post->getFirstMediaUrl('images','thumbnail') }}" width="120px"></td>

                            
                        <td>{{ $post->updated_at }}</td>
                    </tr>
                    
                @endforeach
                
            @endif
        </tbody>
    </table>



</x-tenapp-layout>