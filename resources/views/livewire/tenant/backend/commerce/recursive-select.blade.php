@foreach ($product_categories as $product_category)
                            
    <option value={{ $product_category->id }}>{{  $prefix.' '.$product_category->title }}</option> 

    @if (!empty($product_category->children))
        @php
            $prefix = $prefix.'-';
        @endphp
         @include('livewire.tenant.backend.commerce.recursive-select', [
                'product_categories' => $product_category->children
            ])
        @php
            $prefix = substr($prefix, 0, -1);
        @endphp     
    @endif
    
@endforeach