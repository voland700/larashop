<li class="nav-item has-treeview">
    <a href="{{route('products.index')}}" class="nav-link">
        <i class="nav-icon far fa-folder"></i><p>Каталог<i class="right fas fa-angle-left"></i></p>
    </a>





    <ul class="nav nav-treeview   88888" style="display: none;" >
    @foreach ($categories as $category)
         <li class="nav-item  @if(count($category->children)>0) has-treeview @endif" >
             <a href="{{route('products.show', $category->id)}}" class="nav-link"> <i class="far fa-circle nav-icon"></i>
             <p>{{$category->name}}@if(count($category->children)>0)<i class="right fas fa-angle-left"></i>@endif</p></a>


          @if(count($category->children)>0)
           <ul class="nav nav-treeview" style="display: none;">
            @foreach ($category->children as $childCategory)
               @include('admin.layouts.child_category', ['childCategor' => $childCategory])
            @endforeach
            </ul>
            @endif
            </li>
    @endforeach
        <hr>
    </ul>



</li>






<li class="nav-item">
    <a href="{{route('categories.index')}}" class="nav-link">
        <i class="nav-icon fas fa-list-ul"></i>
        <p>Категории</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('attributes.index')}}" class="nav-link">
        <i class="nav-icon fas fa-clipboard-list"></i>
       <p>Характеристики</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('currency.index')}}" class="nav-link">
        <i class="nav-icon fab fa-btc"></i>
        <p>Курсы валют</p>
    </a>
</li>
