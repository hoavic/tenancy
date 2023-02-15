@foreach ($categories as $category)

    <div class="pl-2">
        <div class="my-2 flex gap-2 items-center">
            <input id="cat{{ $category->id }}" class="rounded" type="checkbox" name="categories" value="{{ $category->id }}">
            <label for="cat{{ $category->id }}">{{ $category->title }}</label>
        </div>
    @if (!empty($category->children))

        @include('tenant.backend.posts.recursive-category', ['categories' => $category->children])

    @endif

    </div>
    
@endforeach