<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon far fa-folder"></i><p>Каталог<i class="right fas fa-angle-left"></i></p>
    </a>





    <ul class="nav nav-treeview" style="display: none;">
    @foreach ($categories as $category)
         <li class="nav-item">
             <a href="pages/charts/chartjs.html" class="nav-link"> <i class="far fa-circle nav-icon"></i><p>{{$category->name}}</p></a>
         </li>
          @if(count($category->children)>0)
            @foreach ($category->children as $childCategory)
               @include('child_category', ['child_category' => $childCategory])
            @endforeach
         @endif
    @endforeach
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
