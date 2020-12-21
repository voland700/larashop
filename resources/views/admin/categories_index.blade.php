@extends('admin.layouts.layout')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-6">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ $message }}</p>
                    </div>
                @endif



                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>В данном разделе ВЫ можете создовать, редактировать, и удалять - разделы для товаров коталога.</p>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                       <p></p>
                    </div>
                    <!-- /.card-footer-->
                </div>


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Список категорий</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('categories.create')}}" type="button" class="btn btn-primary mb-3">Добавить</a>
                        <table class="table table-bordered">
                            <thead>
                                 <tr>
                                    <th>Название категории</th>
                                    <th  style="width: 10px">Активность</th>
                                    <th  style="width: 10px">ID</th>
                                    <th  style="width: 20px">Удалить</th>
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
                                    echo ' <tr><td>'.PHP_EOL.$prefix.'<a href="'.route("categories.edit", $category->id).'" class="mr-3">'.$category->name.'</a></td><td class="text-center">'.active($category->active).'</td><td>'.$category->id.'</td><td class="text-center"><a href="'.route("categories.destroy", $category->id).'"><i class="text-danger fas fa-trash-alt"></i></a></td></tr>';
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
