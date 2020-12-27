<li class="nav-item  @if(count($childCategory->children)>0) has-treeview @endif" >
    <a href="{{route('products.show', $childCategory->id)}}" class="nav-link">
        -  <p>{{$childCategory->name}}@if(count($childCategory->children)>0)<i class="right fas fa-angle-left"></i>@endif</p></a>
    @if(count($childCategory->children)>0)
        <ul class="nav nav-treeview" style="display: none;">
            @foreach ($childCategory->children as $childCategory)
                @include('admin.layouts.child_category', ['childCategor' => $childCategory])
            @endforeach
        </ul>
    @endif
</li>
