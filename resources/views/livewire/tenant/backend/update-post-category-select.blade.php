@foreach ($categories as $category)

    <div class="pl-2">
        <div class="my-2 flex gap-2 items-center">
            <input id="cat{{ $category->id }}" wire:model="category_ids" class="rounded" type="checkbox" name="categories" value={{ $category->id }} 
            
{{--                 @if ($category->id === $post['category_id'])
                    checked
                @endif --}}

                @foreach ($category_ids as $post_cat_id)
                    @if ($post_cat_id === $category->id)
                        checked
                    @endif
                @endforeach
            
            >
            <label for="cat{{ $category->id }}">{{ $category->title }}</label>
        </div>
    @if (!empty($category->children))

        @include('livewire.tenant.backend.update-post-category-select', ['categories' => $category->children])

    @endif

    </div>
    
@endforeach