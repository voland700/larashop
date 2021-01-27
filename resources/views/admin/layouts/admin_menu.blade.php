<li class="nav-item has-treeview">
    <a class="nav-link" id="Catalog">
        <i class="nav-icon far fa-folder"></i><p>Каталог<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="ul_menu">
        <li class="has_children"><span class="m_label m_closed"></span>
            <a href="/admin/catalog_list/" class="m_main_link"><i class="far fa-folder fa-lg"></i>Каталог товаров</a>
            <ul class="ul_in">
            @foreach ($categories as $category)
            <li><span class="m_label {{(count($category->children)>0) ? 'm_closed'  : 'm_none' }}"></span>
                <a href="{{route('catalog_list', $category->id)}}">{{$category->name}}</a>
                @if(count($category->children)>0)
                    <ul class="ul_in">
                        @foreach ($category->children as $childCategory)
                            @include('admin.layouts.child_categories', ['childCategory' => $childCategory])
                        @endforeach
                    </ul>
                @endif
            </li>
             @endforeach
            </ul>
        </li>
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
