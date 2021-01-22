<li><span class="m_label {{(count($category->children)>0) ? 'm_closed'  : 'm_none' }}"></span>
    <a href="{{route('catalog_list', $category->id)}}">{{$category->name}}</a>
    @if(count($childCategory->children)>0)
        <ul class="ul_in">
            @foreach ($childCategory->children as $childCategory)
                @include('admin.layouts.child_categories', ['childCategor' => $childCategory])
            @endforeach
        </ul>
    @endif
</li>



