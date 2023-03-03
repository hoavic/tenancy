@foreach ($categories as $category)
                            
    <option value={{ $category->id }}>{{  $prefix.' '.$category->title }}</option> 

    @if (!empty($category->children))
        @php
            $prefix = $prefix.'-';
        @endphp
        @include('tenant.backend.categories.recursive-select', [
                'categories' => $category->children
            ])
        @php
            $prefix = substr($prefix, 0, -1);
        @endphp     
    @endif
    
@endforeach