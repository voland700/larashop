@extends('admin.layouts.layout')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Список категорий</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('new_product', $id)}}" type="button" class="btn btn-primary mb-3">Создать товар</a>
                        <a href="{{route('categories.create')}}" type="button" class="btn btn-primary mb-3">Создать раздел</a>
                        <table class="table table-bordered">
                            <thead>
                                 <tr>
                                     <th  style="width: 10px">Тип</th>
                                    <th>Название</th>
                                    <th  style="width: 10px">Сортировка</th>
                                    <th  style="width: 10px">Активность</th>
                                    <th  style="width: 10px">ID</th>
                                    <th  style="width: 30px">Редактировать</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    function active($type){
                                    if($type) {
                                        return '<i class="text-success far fa-check-circle"></i>';
                                    } else {
                                        return '<i class="text-danger fas fa-ban"></i>';
                                    }}


                                    $traverse = function ($categories, $prefix = '&#8212;&#8194;') use (&$traverse) {
                                    foreach ($categories as $category) {
                                        $line = '<tr><td class="text-center"><i class="far fa-folder"></i></td><td>';
                                        $line .= PHP_EOL.$prefix.'<a href="'.route('catalog_list', $category->id).'" class="mr-3">'.$category->name.'</a></td><td class="text-center">';
                                        $line .= $category->sort.'</td><td class="text-center">'.active($category->active).'</td><td class="text-center">'.$category->id.'</td>';
                                        $line .= '<td class="text-center"><a href="'.route("categories.edit", $category->id).'" class="btn btn-info mr-1"><i class="fas fa-pencil-alt"></i></a>';


                                        $line .= '<a href="'.route("categories.destroy", $category->id).'" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a></td></tr>';
                                        echo $line;
                                        $traverse($category->children, $prefix.'&#8212;&#8194;');

                                        }
                                    };
                                    $traverse($categories);
                                @endphp
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_del">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Внимание!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="form_content"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <form action="" method="POST" id="sendBtn">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div><!-- /.модальное окно-Содержание -->
        </div><!-- /.модальное окно-диалог -->
    </div><!-- /.модальное окно -->





@endsection
