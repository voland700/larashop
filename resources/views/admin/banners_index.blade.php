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
                        <h3 class="card-title">Банеры слайдера</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('banners.create')}}" type="button" class="btn btn-primary mb-3">Создать</a>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">N</th>
                                <th>Наименование</th>
                                <th style="width: 20px">Активность</th>
                                <th style="width: 20px">Сортировка</th>
                                <th style="width: 120px">Редактировать</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($banners as $banner)
                            <tr>
                                <td style="text-align: center">{{$loop->iteration}}</td>
                                <td>{{$banner->name ?? ''}}</td>
                                <td style="text-align: center">{!!($banner->active ==1) ? '<i class="text-success far fa-check-circle"></i>' : '<i class="text-danger fas fa-ban"></i>'!!}</td>
                                <td style="text-align: center">{{$banner->sort}}</td>
                                <td>
                                    <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('banners.destroy', $banner->id) }}" type="button" data-name="{{$banner->name}}" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
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
