@foreach ($categories as $category)
                            
    <tr class="border-b border-gray-200">
        <td><input type="checkbox" name="" class="rounded"/></td>
        <td class="has-sub">{{ $prefix.' '.$category->title }}
            <div class="sub-item">
                <a href="{{ route('ten.categories.index').'\\'.$category->id }}">Chỉnh sửa</a> 
                <form method="POST" action="{{ route('ten.categories.destroy', $category) }}">
                    @csrf
                    @method('delete')
                    <a href="{{ route('ten.categories.destroy', $category) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Xóa') }}
                    </a>
                </form>
            </div></td>
        <td>{{ $category->description }}</td>
        <td>{{ $category->slug }}</td>
        <td>{{ $category->count }}</td>
    </tr>

    @if (!empty($category->children))
        @php
            $prefix = $prefix.'-';
        @endphp
        @include('tenant.backend.categories.recursive', [
                'categories' => $category->children
            ])

        @php
            $prefix = substr($prefix, 0, -1);
        @endphp    
    @endif
    
@endforeach