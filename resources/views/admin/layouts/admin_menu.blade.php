



<li class="nav-item has-treeview">
    <a class="nav-link">
        <i class="nav-icon far fa-folder"></i><p>Каталог<i class="right fas fa-angle-left"></i></p>
    </a>

    <ul class="ul_menu">
        <li class="has_children"><span class="m_label m_closed"></span>
            <a href="/">Первая категория товаров</a>
            <ul class="ul_in">
                <li><span class="m_label m_none"></span><a href="/"></span>Вложеная категория товаров</a></li>
                <li><span class="m_label m_none"></span><a href="/"></span>Вторая вложеная категория товаров</a></li>
                <li><span class="m_label m_none"></span><a href="/"></span>Третяя вложеная категория товаров</a></li>
            </ul>
        </li>
        <li><span class="m_label m_none"></span><a href="#">Без вложения категория</a></li>
        <li class="has_children"><span class="m_label m_closed"></span>
            <a href="/">Первая категория товаров</a>
            <ul class="ul_in">
                <li class="has_children"><span class="m_label m_closed"></span>
                    <a href="/">Вложеная категория товаров</a>
                    <ul class="ul_in">
                        <li><span class="m_label m_none"></span><a href="/"></span>Вложеная категория товаров</a></li>
                        <li><span class="m_label m_none"></span><a href="/"></span>Вторая вложеная категория товаров</a></li>
                        <li><span class="m_label m_none"></span><a href="/"></span>Третяя вложеная категория товаров</a></li>
                    </ul>
                </li>
                <li><span class="m_label m_none"></span><a href="/"></span>Вторая вложеная категория товаров</a></li>
                <li><span class="m_label m_none"></span><a href="/"></span>Третяя вложеная категория товаров</a></li>
            </ul>
        </li>
        <li><span class="m_label m_none"></span><a href="#">Четвертая главная категория</a></li>
    </ul>
</li>





<li class="nav-item has-treeview">
    <a href="{{route('products.index')}}" class="nav-link">
        <i class="nav-icon far fa-folder"></i><p>Каталог<i class="right fas fa-angle-left"></i></p>
    </a>





    <ul class="nav nav-treeview " style="display: none;" >
    @foreach ($categories as $category)
         <li class="nav-item  @if(count($category->children)>0) has-treeview @endif" >
             <a href="{{route('catalog_list', $category->id)}}" class="nav-link"> <i class="far fa-circle nav-icon"></i>
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
