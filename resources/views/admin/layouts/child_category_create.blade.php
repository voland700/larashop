<option  value="{{ $child_category->id }}">{{ $child_category->name }}</option>
@if ($child_category->categories)
        @foreach ($child_category->categories as $childCategory)
            @include('child_category_create', ['child_category' => $childCategory])
        @endforeach
@endif


