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



                        <ul>
                        @foreach ($categories as $category)
                            <li><a href="{{route("categories/{$category->id}/edit")}}">{{ $category->name }}</a> <a href="{{route("categories/{$category->id}")}}"><i class="fas fa-trash-alt"></i></a></li>
                                @if(count($category->children))
                                <ul>
                                    @foreach($category->children as $category_2)
                                        <li><a href="{{route("categories/{$category_2->id}/edit")}}">{{ $category_2->name }}</a> <a href="{{route("categories/{$category_2->id}")}}"><i class="fas fa-trash-alt"></i></a></li>
                                        @if(count($category_2->children))
                                            <ul>
                                                @foreach($category_2->children as $category_3)
                                                    <li><a href="{{route("categories/{$category_3->id}/edit")}}">{{ $category_3->name }}</a> <a href="{{route("categories/{$category_3->id}")}}"><i class="fas fa-trash-alt"></i></a></li>
                                                    @if(count($category_3->children))
                                                        <ul>
                                                            @foreach($category_3->children as $category_4)
                                                                <li><a href="{{route("categories/{$category_4->id}/edit")}}">{{ $category_4->name }}</a> <a href="{{route("categories/{$category_4->id}")}}"><i class="fas fa-trash-alt"></i></a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endforeach
                                </ul>
                                @endif
                        @endforeach
                        </ul>

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
