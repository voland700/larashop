<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Blank Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
    <style>
        .ck-editor__editable_inline{
            min-height: 300px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../../index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('clear.cash')}}" class="nav-link">Cash</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('assets/admin/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('assets/admin/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="{{ asset('assets/admin/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('admin.index')}}" class="brand-link">
            <img src="{{ asset('assets/admin/img/AdminLTELogo.png') }}"
                 alt="Admin-Panel"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('assets/admin/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    @include('admin.layouts.admin_menu')

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@php echo $h1 ?? 'Заголовок' @endphp</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{ asset('assets/admin/js/admin.js') }}"></script>

<script src="{{ asset('assets/admin/plugins/ckeditor5/build/ckeditor.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/ckfinder/ckfinder.js') }}"></script>
<script>
    document.querySelectorAll('.delete').forEach(function (item) {
        item.addEventListener('click', modalShow);
    })

    function modalShow(elem){
        elem.preventDefault();
        let item = elem.target.closest('.delete');
        let url = item.getAttribute('href');
        document.getElementById('form_content').innerHTML = 'Вы действительно хотите удалить - <strong class="text-danger">'+item.getAttribute('data-name')+'</strong>?';
        document.getElementById('sendBtn').setAttribute('action', url);
        $('#modal_del').modal('show');
    }
/*
    ClassicEditor
        .create( document.querySelector( '#description' ), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'undo',
                    'redo',
                    '|',
                    'bold',
                    'italic',
                    'fontColor',
                    'fontFamily',
                    'fontSize',
                    'highlight',
                    'alignment',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'indent',
                    'outdent',
                    '|',
                    'htmlEmbed',
                    'link',
                    'blockQuote',
                    'insertTable',
                    'mediaEmbed',
                    'CKFinder'
                ]
            },
            language: 'ru',
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },
        } )
        .catch( function( error ) {
            console.error( error );
        } );

*/

    //Translit
    function translit(word){
        var converter = {
            'а': 'a',    'б': 'b',    'в': 'v',    'г': 'g',    'д': 'd',
            'е': 'e',    'ё': 'e',    'ж': 'zh',   'з': 'z',    'и': 'i',
            'й': 'y',    'к': 'k',    'л': 'l',    'м': 'm',    'н': 'n',
            'о': 'o',    'п': 'p',    'р': 'r',    'с': 's',    'т': 't',
            'у': 'u',    'ф': 'f',    'х': 'h',    'ц': 'c',    'ч': 'ch',
            'ш': 'sh',   'щ': 'sch',  'ь': '',     'ы': 'y',    'ъ': '',
            'э': 'e',    'ю': 'yu',   'я': 'ya'
        };
        word = word.toLowerCase();
        var answer = '';
        for (var i = 0; i < word.length; ++i ) {
            if (converter[word[i]] == undefined){
                answer += word[i];
            } else {
                answer += converter[word[i]];
            }
        }
        answer = answer.replace(/[^-0-9a-z]/g, '-');
        answer = answer.replace(/[-]+/g, '-');
        answer = answer.replace(/^\-|-$/g, '');
        return answer;
    }

    if(document.getElementById('CreateName')){
        document.getElementById('CreateName').oninput = function () {
            const CreateSlug = document.getElementById('CreateSlug');
            CreateSlug.value = translit(CreateName.value);
        }
    }


    function checkboxToggle(e) {
        let elem = document.getElementById('active');
        if(elem.checked){
            elem.value = 1;
        } else {
            elem.value = 0;
        }
    }
    document.querySelectorAll('.toggle').forEach(function(item){
        item.addEventListener('click', function (e) {
            let elem = item.querySelector('input[type=checkbox]');
            if(elem.value == 0){
                elem.value = 1;
                elem.setAttribute('checked', 'checked');
            }else{
                elem.value = 0;
                elem.removeAttribute('checked');
            }
        });
    });

    //Input -show file name
    document.querySelectorAll('.custom-file-input').forEach(function (item) {
            item.addEventListener('change',function(e){
            let fileName = e.target.files[0].name;
            let nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        })
    })


    function imgDelete(elem){
        let item = elem.target;
        $.ajax(
            {
                url: '{{ route('category_img')}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    'id': item.getAttribute('data-id'),
                    'field': item.getAttribute('data-field')
                },
                success: function () {
                    location.reload();
                }
            });
        return false;
    }

    function imageRemove(elem) {
        elem.preventDefault();
        let item = elem.currentTarget;
        let parentImg = item.parentNode.querySelector('.product_photo');
        $.ajax(
            {
                url: item.href,
                type: 'POST',
                data: {
                    _token: document.getElementById('productUpdate').querySelector('[name="_token"]').value,
                    'id': item.getAttribute('data-id'),
                },
                success: function (response) {
                    //location.reload();
                    parentImg.style.opacity = 0.4;
                },
                error: function (response) {
                    console.log(response);
                }
            });
    }

    function imageAllRemove(elem) {
        elem.preventDefault();
        let item = elem.currentTarget;
        let parentImages = document.querySelectorAll('.product_photo');
        $.ajax(
            {
                url: item.href,
                type: 'POST',
                data: {
                    _token: document.getElementById('productUpdate').querySelector('[name="_token"]').value,
                    'id': item.getAttribute('data-id'),
                },
                success: function (response) {
                    //location.reload();
                    parentImages.forEach(function (item) {
                        item.style.opacity = 0.4;
                    });
                },
                error: function (response) {
                    console.log(response);
                }
            });
    }

    //Меню каталога
    document.getElementById('Catalog').addEventListener('click', function (elem) {

        let mainElem = elem.currentTarget.parentNode;
        mainElem.classList.toggle('menu-open');
        let ulmenu = mainElem.parentNode.querySelector('.ul_menu');
        if(ulmenu.style.display != 'block'){
            ulmenu.style.display = 'block';
        } else {
            ulmenu.style.display = '';
        }
        document.querySelectorAll('.m_label').forEach(function (item, idx) {
            item.addEventListener('click', function (elem) {
                let item = elem.target;
                function openUl(item) {
                    let ul = item.parentNode.querySelector('.ul_in');
                    if(ul.style.display != 'block'){
                        ul.style.display = 'block';
                    } else {
                        ul.style.display = '';
                    }
                }
                if(item.nextElementSibling.classList.contains('m_main_link')){
                    let mainLink = item.nextElementSibling.querySelector('i');
                    mainLink.classList.toggle('fa-folder');
                    mainLink.classList.toggle('fa-folder-open');
                    console.log(mainLink);
                };

                if(item.classList.contains('m_none')){
                    return false;
                } else {
                    if(item.classList.contains('m_closed')){
                        item.classList.remove('m_closed');
                        item.classList.add('m_open');
                        openUl(item);
                        return false;
                    }
                    if(item.classList.contains('m_open')){
                        item.classList.remove('m_open');
                        item.classList.add('m_closed');
                        openUl(item);
                        return false;
                    }
                }
            });
        });
    });

    function ChangeGoods() {
        let kind = document.getElementById('choiceGoods').value;

         $.ajax(
            {
                url: '{{route('discounts_goods')}}',
                type: 'POST',
                data: {
                    _token: document.getElementById('DiscountsForm').querySelector('[name="_token"]').value,
                    'kind': kind
                },
                success: function (response) {
                    switch (kind) {
                        case 'goods':
                            let modalBody = document.getElementById('modalBody');
                            modalBody.innerHTML = response;
                            $('#modal-xl').modal('show');
                            choiceGoods();
                            selectionGoods();
                            discountPaginate();
                            break;
                        case 'category':
                            const modalBodyCategories = document.getElementById('modalBodyCategories');
                            modalBodyCategories.innerHTML = response;
                            $('#modalCategory').modal('show');
                            document.getElementById('btnChoiceCategories').addEventListener('click', getCategories);
                            break;
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });

            function choiceGoods() {
                document.querySelectorAll('.d_label').forEach(function (item) {
                    item.addEventListener('click', function(e){
                        let elem = e.target;
                        let ul = elem.parentNode.nextElementSibling;
                        if(elem.classList.contains('d_label-closed')){
                            elem.classList.remove('d_label-closed');
                            elem.classList.add('d_label-open');
                        }
                        else if(elem.classList.contains('d_label-open')){
                            elem.classList.remove('d_label-open');
                            elem.classList.add('d_label-closed');
                        }
                        if(ul.classList.contains('d_closed')){
                            ul.classList.remove('d_closed');
                            ul.classList.add('d_open');
                        }
                        else if(ul.classList.contains('d_open')){
                            ul.classList.remove('d_open');
                            ul.classList.add('d_closed');
                        }
                    });
                });
            }
    }

    function ChoiceGoodsCategory(id) {
        let DiscountContemt = document.getElementById('DiscountContemt');
        $.ajax(
            {
                url: '{{route('discounts_choice')}}',
                type: 'POST',
                data: {
                    _token: document.getElementById('DiscountsForm').querySelector('[name="_token"]').value,
                    'id': id
                },
                success: function (response) {
                    //location.reload();
                    //console.log(response);
                    DiscountContemt.innerHTML = response;
                    selectionGoods();
                    discountPaginate();
                },
                error: function (response) {
                    console.log(response);
                }
            });
    }

    function selectionGoods(){
        let arrID = [];
        document.querySelectorAll('.d_btn').forEach(function (item) {
            item.addEventListener('click', function(e){
                let elem = e.currentTarget;
                const GoodsList =document.getElementById('GoodsList');
                if(elem.classList.contains('btn-default') && !elem.classList.contains('btn-success')){
                    elem.classList.remove('btn-default');
                    elem.classList.add('btn-success');
                }
                let id = elem.getAttribute('data-id');
                let name = elem.getAttribute('data-name');
                let li = document.createElement("li");
                let btn = document.createElement("span");
                let namberId = document.createElement("span");
                let input = document.createElement("input");

                input.setAttribute('type', 'hidden');
                input.setAttribute('name', `productsID[]`);
                input.setAttribute('value', id);

                namberId.className = "d_id";
                namberId.innerText = '('+id+')';
                btn.className = "d_btn-del";
                btn.innerText = '×';
                btn.addEventListener('click', function(){
                    arrID.splice(arrID.indexOf(id),1);
                    this.parentNode.remove();
                });
                li.innerText = name;
                li.append(namberId);
                li.append(btn);
                li.append(input);
                if(!arrID.includes(id)){
                    arrID.push(id);
                    GoodsList.append(li);
                    document.querySelector('.discount-list').style.display = 'block';
                }
            });
        });
    }

    function discountPaginate() {
        const DiscountContemt = document.getElementById('DiscountContemt');
        document.querySelectorAll('.dis_link').forEach(function (item) {
            item.addEventListener('click', function(e){
                e.preventDefault();
                const url =e.currentTarget.getAttribute('href');
                let params = url.substr(url.indexOf('?')+1).split('&').reduce(function(p,e){
                    var a = e.split('=');
                    p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
                    return p;
                     },
                     {}
                );
                $.ajax(
                    {
                        url: '{{route('discounts_paginate')}}',
                        type: 'GET',
                        data: {
                            _token: document.getElementById('DiscountsForm').querySelector('[name="_token"]').value,
                            'page': params.page,
                            'category': params.category
                        },
                        success: function (response) {
                            DiscountContemt.innerHTML = response;
                            selectionGoods();
                            discountPaginate();
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
            });
        });
    }

    function  getCategories(){
        let selected = Array.from(FormChoice.options).filter(option => option.selected);
            //.map(option => option.value);
        const GoodsList =document.getElementById('GoodsList');
        selected.forEach(function (item) {
            let id = item.value;
            let name = item.getAttribute('data-name');
            let li = document.createElement("li");
            let btn = document.createElement("span");
            let namberId = document.createElement("span");
            let input = document.createElement("input");
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', `productsID[]`);
            input.setAttribute('value', id);
            namberId.className = "d_id";
            namberId.innerText = '('+id+')';
            btn.className = "d_btn-del";
            btn.innerText = '×';
            btn.addEventListener('click', function(){
                selected.splice(selected.indexOf(id),1);
                this.parentNode.remove();
            });
            li.innerText = name;
            li.append(namberId);
            li.append(btn);
            li.append(input);
            GoodsList.append(li);
        });
        if(!selected.length == 0){
            document.querySelector('.discount-list').style.display = 'block';
            $('#modalCategory').modal('toggle');
        }
    }



    // DISCOUNT UPDATE
    function RemoveElem(e) {
        e.parentNode.remove();
    }

    function ChangeUpdateGoods(){
        let kind = document.getElementById('choiceGoods').value;
        let arrItemsId = [];
        document.querySelectorAll('.d_input').forEach(function (item) {
            arrItemsId.push(Number(item.value));
        });
        $.ajax(
            {
                url: '{{route('discounts_goods_update')}}',
                type: 'POST',
                data: {
                    _token: document.getElementById('DiscountsForm').querySelector('[name="_token"]').value,
                    'kind': kind,
                    'items_id': arrItemsId,
                },
                success: function (response) {
                    switch (kind) {
                        case 'goods':
                            let modalBody = document.getElementById('modalBody');
                            modalBody.innerHTML = response;
                            $('#modal-xl').modal('show');
                            choiceGoods();
                            selectionGoodsUptate();
                            //selectionGoods();
                            discountPaginate();
                            break;
                        case 'category':
                            const modalBodyCategories = document.getElementById('modalBodyCategories');
                            modalBodyCategories.innerHTML = response;
                            $('#modalCategory').modal('show');
                            document.getElementById('btnChoiceCategoriesUpdate').addEventListener('click', updateCategories);
                            break;
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });

        function choiceGoods() {
            document.querySelectorAll('.d_label').forEach(function (item) {
                item.addEventListener('click', function(e){
                    let elem = e.target;
                    let ul = elem.parentNode.nextElementSibling;
                    if(elem.classList.contains('d_label-closed')){
                        elem.classList.remove('d_label-closed');
                        elem.classList.add('d_label-open');
                    }
                    else if(elem.classList.contains('d_label-open')){
                        elem.classList.remove('d_label-open');
                        elem.classList.add('d_label-closed');
                    }
                    if(ul.classList.contains('d_closed')){
                        ul.classList.remove('d_closed');
                        ul.classList.add('d_open');
                    }
                    else if(ul.classList.contains('d_open')){
                        ul.classList.remove('d_open');
                        ul.classList.add('d_closed');
                    }
                });
            });
        }

        function selectionGoodsUptate(){
            const GoodsList =document.getElementById('GoodsList');
            function createElem(id, name){
                let li = document.createElement("li");
                let btn = document.createElement("span");
                let namberId = document.createElement("span");
                let input = document.createElement("input");
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', `productsID[]`);
                input.setAttribute('value', id);
                namberId.className = "d_id";
                namberId.innerText = '['+id+']';
                btn.className = "d_btn-del";
                btn.innerText = '×';
                btn.addEventListener('click', function(){
                    arrItemsId.splice(arrItemsId.indexOf(id),1);
                    this.parentNode.remove();
                });
                li.innerText = name;
                li.append(namberId);
                li.append(btn);
                li.append(input);
                if(!arrItemsId.includes(id)){
                    arrItemsId.push(id);
                    GoodsList.append(li);
                }
            }
            document.querySelectorAll('.d_btn').forEach(function (item) {
                item.addEventListener('click', function(e){
                    let elem = e.currentTarget;
                    let id = elem.getAttribute('data-id');
                    let name = elem.getAttribute('data-name');
                    createElem(id, name);
                    elem.classList.toggle('btn-default');
                    elem.classList.toggle('btn-success');
                });
            });
        }

        function updateCategories(){
            document.getElementById('GoodsList').innerText = '';
            getCategories()
        }














    }











</script>
</body>
</html>
