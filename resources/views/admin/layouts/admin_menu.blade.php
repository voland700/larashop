<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">КАТАЛОГ</li>
<li class="nav-item has-treeview">
    <a class="nav-link" id="Catalog">
        <i class="nav-icon far fa-folder"></i><p>Товары<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="ul_menu">
        <li class="has_children"><span class="m_label m_closed"></span>
            <a href="/admin/catalog_list/" class="m_main_link"><i class="far fa-folder fa-lg"></i>Разделы каталога</a>
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
<li class="nav-item">
    <a href="{{route('discounts.index')}}" class="nav-link">
        <i class="nav-icon fas fa-percent"></i>
        <p>Скидки</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('brands.index')}}" class="nav-link">
        <i class="nav-icon fas fa-cogs"></i>
        <p>Производители</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('advantages.index')}}" class="nav-link">
        <i class="nav-icon fas fa-thumbs-up"></i>
        <p>Преимущества</p>
    </a>
</li>





    <li class="nav-header">КОНТЕНТ</li>

    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
                Слайдер
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">

            <li class="nav-item">
                <a href="{{route('sliders.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Слайды</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('sliders.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Создать слайд</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{route('banners.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Банеры слайдера</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('banners.create')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Создать банер</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="{{route('services.index')}}" class="nav-link">
            <i class="nav-icon fab fa-whmcs"></i>
            <p>Услуги</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('blogs.create')}}" class="nav-link">
            <i class="nav-icon fas fa-paste"></i>
            <p>Статьи</p>
        </a>
    </li>


</ul>
